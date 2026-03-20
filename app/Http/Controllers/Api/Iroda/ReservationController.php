<?php

namespace App\Http\Controllers\Api\Iroda;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ReservationStatusUpdate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class ReservationController extends Controller
{
    /**
     * Display a listing of reservations with pagination
     */
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 20);
        $page = $request->get('page', 1);
        
        $reservations = Reservation::with(['destination', 'user'])
            ->orderBy('created_at', 'desc')
            ->paginate($perPage, ['*'], 'page', $page);

        return response()->json([
            'data' => $reservations->items(),
            'pagination' => [
                'current_page' => $reservations->currentPage(),
                'last_page' => $reservations->lastPage(),
                'per_page' => $reservations->perPage(),
                'total' => $reservations->total(),
                'from' => $reservations->firstItem(),
                'to' => $reservations->lastItem(),
            ]
        ]);
    }

    /**
     * Display the specified reservation
     */
    public function show(Reservation $reservation)
    {
        $reservation->load(['destination', 'user']);
        
        return response()->json([
            'data' => $reservation
        ]);
    }

    /**
     * Update reservation details
     */
    public function updateReservationDetails(Request $request, $id)
    {
        $reservation = Reservation::find($id);
        
        if (!$reservation) {
            return response()->json([
                'message' => 'Reservation not found'
            ], 404);
        }

        // Update directly without validation
        $reservation->update([
            'full_name' => $request->full_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'people_count' => $request->people_count,
        ]);

        return response()->json([
            'message' => 'Reservation details updated successfully',
            'data' => $reservation->load(['destination', 'user'])
        ]);
    }

    public function updateDetails(Request $request, $id)
    {
        $reservation = Reservation::find($id);
        
        if (!$reservation) {
            return response()->json([
                'message' => 'Reservation not found'
            ], 404);
        }

        // Update directly without validation
        $reservation->update([
            'full_name' => $request->full_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'people_count' => $request->people_count,
        ]);

        return response()->json([
            'message' => 'Reservation details updated successfully',
            'data' => $reservation->load(['destination', 'user'])
        ]);
    }

    /**
     * Update reservation status
     */
    public function updateStatus(Request $request, $id)
    {
        $reservation = Reservation::find($id);
        
        if (!$reservation) {
            return response()->json([
                'message' => 'Reservation not found'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'status' => ['required', 'in:pending,confirmed,cancelled'],
            'admin_notes' => ['nullable', 'string', 'max:1000'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        $data = $validator->validated();
        $oldStatus = $reservation->status;
        $reservation->update($data);

        // Send confirmation email if status changed to confirmed
        if ($oldStatus !== $data['status'] && $data['status'] === 'confirmed' && !empty($reservation->email)) {
            try {
                $mailData = [
                    'full_name' => $reservation->full_name,
                    'email' => $reservation->email,
                    'message' => 'Foglalását megerősítettük! Köszönjük a bizalmát, várjuk az utazáson.',
                    'destination_title' => $reservation->destination->title ?? 'Utazás',
                    'status' => $data['status'],
                    'admin_notes' => $data['admin_notes'] ?? null,
                ];

                $mailable = new ReservationStatusUpdate($mailData);
                Mail::to($reservation->email)->send($mailable);

                // Mark email as sent
                $reservation->email_sent = true;
                $reservation->save();

                Log::info('Confirmation email sent', [
                    'reservation_id' => $reservation->id,
                    'email' => $reservation->email,
                    'status' => $data['status']
                ]);
            } catch (\Throwable $e) {
                Log::error('Failed to send confirmation email', [
                    'reservation_id' => $reservation->id,
                    'error' => $e->getMessage()
                ]);
            }
        }

        return response()->json([
            'message' => 'Reservation status updated successfully',
            'data' => $reservation->load(['destination', 'user'])
        ]);
    }

    /**
     * Send custom email to reservation
     */
    public function sendEmail(Request $request, $id)
    {
        $reservation = Reservation::find($id);
        
        if (!$reservation) {
            return response()->json([
                'message' => 'Reservation not found'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'message' => ['required', 'string', 'max:2000'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $mailData = [
                'full_name' => $reservation->full_name,
                'email' => $reservation->email,
                'message' => $request->message,
                'destination_title' => $reservation->destination->title ?? 'Utazás',
                'status' => $reservation->status,
            ];

            $mailable = new ReservationStatusUpdate($mailData);
            Mail::to($reservation->email)->send($mailable);

            // Mark email as sent
            $reservation->email_sent = true;
            $reservation->save();

            Log::info('Custom email sent to reservation', [
                'reservation_id' => $reservation->id,
                'email' => $reservation->email
            ]);

            return response()->json([
                'message' => 'Email sent successfully',
                'data' => $reservation
            ]);
        } catch (\Throwable $e) {
            Log::error('Failed to send custom email', [
                'reservation_id' => $reservation->id,
                'error' => $e->getMessage()
            ]);

            return response()->json([
                'message' => 'Failed to send email: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified reservation
     */
    public function destroy(Reservation $reservation)
    {
        $reservation->delete();

        return response()->json([
            'message' => 'Reservation deleted successfully'
        ]);
    }
}
