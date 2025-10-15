<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class DestinationController extends Controller
{
    public function index()
    {
        $destinations = Destination::orderBy('title')->paginate(20);
        return view('admin.destinations.index', compact('destinations'));
    }

    public function create()
    {
        return view('admin.destinations.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'slug' => ['required', 'string', 'max:255'],
            'title' => ['required', 'string', 'max:255'],
            'price_huf' => ['required', 'integer', 'min:0'],
            'start_date' => ['nullable', 'date'],
            'end_date' => ['nullable', 'date', 'after_or_equal:start_date'],
            'image_path' => ['required', 'string', 'max:1024'],
            'image2_path' => ['nullable', 'string', 'max:1024'],
            'detail_url' => ['nullable', 'string', 'max:1024'],
            'leiras' => ['nullable', 'string'],
        ]);

        Destination::create($data);

        return Redirect::route('admin.destinations.index')->with('status', 'Uticél létrehozva.');
    }

    public function edit(Destination $destination)
    {
        return view('admin.destinations.edit', compact('destination'));
    }

    public function update(Request $request, Destination $destination)
    {
        $data = $request->validate([
            'slug' => ['required', 'string', 'max:255'],
            'title' => ['required', 'string', 'max:255'],
            'price_huf' => ['required', 'integer', 'min:0'],
            'start_date' => ['nullable', 'date'],
            'end_date' => ['nullable', 'date', 'after_or_equal:start_date'],
            'image_path' => ['required', 'string', 'max:1024'],
            'image2_path' => ['nullable', 'string', 'max:1024'],
            'detail_url' => ['nullable', 'string', 'max:1024'],
            'leiras' => ['nullable', 'string'],
        ]);

        $destination->update($data);

        return Redirect::route('admin.destinations.index')->with('status', 'Uticél frissítve.');
    }

    public function destroy(Destination $destination)
    {
        $destination->delete();
        return Redirect::route('admin.destinations.index')->with('status', 'Uticél törölve.');
    }
}
