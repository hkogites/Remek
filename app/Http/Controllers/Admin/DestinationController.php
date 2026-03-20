<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;

class DestinationController extends Controller
{
    private function getRoutePrefix()
    {
        $currentRoute = Route::currentRouteName();
        return str_starts_with($currentRoute, 'iroda.') ? 'iroda' : 'admin';
    }

    public function index()
    {
        $destinations = Destination::orderBy('title')->paginate(20);
        $prefix = $this->getRoutePrefix();
        return view('admin.destinations.index', compact('destinations', 'prefix'));
    }

    public function create()
    {
        $prefix = $this->getRoutePrefix();
        return view('admin.destinations.create', compact('prefix'));
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

        $prefix = $this->getRoutePrefix();
        return Redirect::route("{$prefix}.destinations.index")->with('status', 'Uticél létrehozva.');
    }

    public function edit(Destination $destination)
    {
        $prefix = $this->getRoutePrefix();
        return view('admin.destinations.edit', compact('destination', 'prefix'));
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

        $prefix = $this->getRoutePrefix();
        return Redirect::route("{$prefix}.destinations.index")->with('status', 'Uticél frissítve.');
    }

    public function destroy(Destination $destination)
    {
        $destination->delete();
        $prefix = $this->getRoutePrefix();
        return Redirect::route("{$prefix}.destinations.index")->with('status', 'Uticél törölve.');
    }
}
