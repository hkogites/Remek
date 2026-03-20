<?php

namespace App\Http\Controllers\Iroda;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ReservationStatusUpdate;
use Illuminate\Support\Facades\Log;

class ReservationController extends Controller
{
    public function index()
    {
        $reservations = Reservation::with(['destination', 'user'])
            ->orderBy('created_at', 'desc')
            ->paginate(20);
        
        return view('iroda.reservations.index', compact('reservations'));
    }

    public function edit(Reservation $reservation)
    {
        return view('iroda.reservations.edit', compact('reservation'));
    }

    public function updateDetails(Request $request, Reservation $reservation)
    {
        $data = $request->validate([
            'full_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:50'],
            'address' => ['nullable', 'string', 'max:255'],
            'people_count' => ['required', 'integer', 'min:1', 'max:20'],
        ]);

        $reservation->update($data);

        return redirect()->route('iroda.reservations.edit', $reservation)
            ->with('status', 'Foglalás részletei frissítve.');
    }

    public function updateStatus(Request $request, Reservation $reservation)
    {
        $data = $request->validate([
            'status' => ['required', 'in:pending,confirmed,cancelled'],
            'admin_notes' => ['nullable', 'string', 'max:1000'],
        ]);

        $oldStatus = $reservation->status;
        $reservation->update($data);

        // Send email notification if status changed
        if ($oldStatus !== $data['status'] && !empty($reservation->email)) {
            try {
                $mailData = [
                    'full_name' => $reservation->full_name,
                    'email' => $reservation->email,
                    'status' => $data['status'],
                    'admin_notes' => $data['admin_notes'] ?? null,
                    'destination_title' => $reservation->destination->title ?? 'Utazás',
                ];

                $mailable = new ReservationStatusUpdate($mailData);
                Mail::to($reservation->email)->send($mailable);

                // Mark email as sent
                $reservation->email_sent = true;
                $reservation->save();

                Log::info('Status update email sent', [
                    'reservation_id' => $reservation->id,
                    'email' => $reservation->email,
                    'status' => $data['status']
                ]);
            } catch (\Throwable $e) {
                Log::error('Failed to send status update email', [
                    'reservation_id' => $reservation->id,
                    'error' => $e->getMessage()
                ]);
            }
        }

        return redirect()->route('iroda.reservations.index')
            ->with('status', 'Foglalás státusza frissítve.');
    }

    public function sendEmail(Request $request, Reservation $reservation)
    {
        $request->validate([
            'message' => ['required', 'string', 'max:2000'],
        ]);

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

            return redirect()->route('iroda.reservations.index')
                ->with('status', 'Email sikeresen elküldve.');
        } catch (\Throwable $e) {
            Log::error('Failed to send custom email', [
                'reservation_id' => $reservation->id,
                'error' => $e->getMessage()
            ]);

            return redirect()->back()
                ->with('error', 'Email küldése sikertelen: ' . $e->getMessage());
        }
    }

    public function destroy(Reservation $reservation)
    {
        $reservation->delete();
        return redirect()->route('iroda.reservations.index')
            ->with('status', 'Foglalás törölve.');
    }
}
