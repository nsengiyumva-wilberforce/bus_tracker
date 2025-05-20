<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bus;
use Illuminate\Http\Request;
use App\Models\Route;

class BusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $buses = Bus::paginate(25);        
        return view('pages.bus.index', compact('buses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $routes = Route::get();
        return view('pages.bus.create', compact('routes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'bus_number' => 'required|string|max:255|unique:buses',
            'route_id' => 'required|exists:routes,id',
            'capacity' => 'required|integer|min:1',
        ]);

        // Create a new bus record
        Bus::create([
            'bus_number' => $request->bus_number,
            'route_id' => $request->route_id,
            'capacity' => $request->capacity,
        ]);

        // Redirect to the buses index page with a success message
        return redirect()->route('buses.index')->with('success', 'Bus created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $bus = Bus::with('route.startingStation', 'route.endingStation')->findOrFail($id);
        dd($bus->toarray());
        return view('pages.bus.show', compact('bus'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $bus = Bus::findOrFail($id);
        $routes = Route::get();
        return view('pages.bus.edit', compact('bus', 'routes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate the request data
        $request->validate([
            'bus_number' => 'required|string|max:255|unique:buses,bus_number,' . $id,
            'route_id' => 'required|exists:routes,id',
            'capacity' => 'required|integer|min:1',
        ]);

        // Find the bus and update it
        $bus = Bus::findOrFail($id);
        $bus->update([
            'bus_number' => $request->bus_number,
            'route_id' => $request->route_id,
            'capacity' => $request->capacity,
        ]);

        // Redirect to the buses index page with a success message
        return redirect()->route('buses.index')->with('success', 'Bus updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Find the bus and delete it
        $bus = Bus::findOrFail($id);
        $bus->delete();

        // Redirect to the buses index page with a success message
        return redirect()->route('buses.index')->with('success', 'Bus deleted successfully.');
    }
}
