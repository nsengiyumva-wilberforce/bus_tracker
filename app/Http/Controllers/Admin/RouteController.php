<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Route;
use App\Models\BusStop;

class RouteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $routes = Route::with(['startingStation', 'endingStation'])->paginate(25);
        return view('pages.routes.index', compact('routes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $busStops = BusStop::all();
        return view('pages.routes.create', compact('busStops'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'starting_station_id' => 'required|exists:bus_stops,id',
            'ending_station_id' => 'required|exists:bus_stops,id',
            'timetable' => 'nullable|array|min:1',
            'timetable.*' => 'string', // Ensure all values are strings
        ]);
    
        // Encode timetable if it's provided and not null
        if (!empty($validated['timetable'])) {
            $validated['timetable'] = json_encode($request->timetable);
        }
    
        Route::create($validated);
        return redirect()->route('routes.index')->with('success', 'Route created successfully.');
    }
    

    /**
     * Display the specified resource.
     */
    public function show(Route $route)
    {
        return view('pages.routes.show', compact('route'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Route $route)
    {
        $busStops = BusStop::all();
        return view('pages.routes.edit', compact('route', 'busStops'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Route $route)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'starting_station_id' => 'required|exists:bus_stops,id',
            'ending_station_id' => 'required|exists:bus_stops,id',
            'timetable' => 'nullable|json',
        ]);

        $route->update($validated);
        return redirect()->route('routes.index')->with('success', 'Route updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Route $route)
    {
        $route->delete();
        return redirect()->route('routes.index')->with('success', 'Route deleted successfully.');
    }
}