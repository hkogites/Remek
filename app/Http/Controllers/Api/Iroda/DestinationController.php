<?php

namespace App\Http\Controllers\Api\Iroda;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DestinationController extends Controller
{
    /**
     * Display a listing of destinations with pagination
     */
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 20);
        $page = $request->get('page', 1);
        
        $destinations = Destination::orderBy('title')
            ->paginate($perPage, ['*'], 'page', $page);

        return response()->json([
            'data' => $destinations->items(),
            'pagination' => [
                'current_page' => $destinations->currentPage(),
                'last_page' => $destinations->lastPage(),
                'per_page' => $destinations->perPage(),
                'total' => $destinations->total(),
                'from' => $destinations->firstItem(),
                'to' => $destinations->lastItem(),
            ]
        ]);
    }

    /**
     * Store a newly created destination
     */
    public function store(Request $request)
    {
        try {
            // Create with only provided fields
            $destination = Destination::create([
                'title' => $request->title,
                'price_huf' => $request->price_huf,
                'slug' => $request->slug,
                'image_path' => $request->image_path,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'detail_url' => $request->detail_url,
                'leiras' => $request->leiras,
                'image2_path' => $request->image2_path,
                'evszak' => $request->evszak,
                'foglallimit' => $request->foglallimit,
            ]);

            return response()->json([
                'message' => 'Destination created successfully',
                'data' => $destination
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error creating destination',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified destination
     */
    public function show($id)
    {
        $destination = Destination::find($id);
        
        if (!$destination) {
            return response()->json([
                'message' => 'Destination not found'
            ], 404);
        }
        
        return response()->json([
            'data' => $destination
        ]);
    }

    /**
     * Update the specified destination
     */
    public function update(Request $request, $id)
    {
        $destination = Destination::find($id);
        
        if (!$destination) {
            return response()->json([
                'message' => 'Destination not found'
            ], 404);
        }

        // Update with only provided fields
        $updateData = [];
        if ($request->has('title')) $updateData['title'] = $request->title;
        if ($request->has('price_huf')) $updateData['price_huf'] = $request->price_huf;
        if ($request->has('slug')) $updateData['slug'] = $request->slug;
        if ($request->has('image_path')) $updateData['image_path'] = $request->image_path;
        if ($request->has('start_date')) $updateData['start_date'] = $request->start_date;
        if ($request->has('end_date')) $updateData['end_date'] = $request->end_date;
        if ($request->has('detail_url')) $updateData['detail_url'] = $request->detail_url;
        if ($request->has('leiras')) $updateData['leiras'] = $request->leiras;
        if ($request->has('image2_path')) $updateData['image2_path'] = $request->image2_path;

        $destination->update($updateData);

        return response()->json([
            'message' => 'Destination updated successfully',
            'data' => $destination
        ]);
    }

    /**
     * Remove the specified destination
     */
    public function destroy($id)
    {
        $destination = Destination::find($id);
        
        if (!$destination) {
            return response()->json([
                'message' => 'Destination not found'
            ], 404);
        }
        
        $destination->delete();

        return response()->json([
            'message' => 'Destination deleted successfully'
        ]);
    }
}
