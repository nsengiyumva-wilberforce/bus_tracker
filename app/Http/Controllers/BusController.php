<?php

// app/Http/Controllers/BusController.php
namespace App\Http\Controllers;

use App\Models\Bus;
use App\Models\Route;
use Illuminate\Http\Request;

class BusController extends Controller
{
    public function index()
    {
        return response()->json(Bus::all());
    }

    public function store(Request $request)
    {
        $bus = Bus::create($request->all());
        return response()->json($bus, 201);
    }

    public function show(Bus $bus)
    {
        return response()->json($bus);
    }

    public function update(Request $request, Bus $bus)
    {
        $bus->update($request->all());
        return response()->json($bus);
    }

    public function destroy(Bus $bus)
    {
        $bus->delete();
        return response()->json(null, 204);
    }

    public function tracking()
    {
        $buses = Bus::with('route', 'route.startingStation', 'route.endingStation')->get();
        return view('tracking', compact('buses'));
    }

    public function bus_routes()
    {
        $routes = Route::with(['startingStation', 'endingStation'])->paginate(25);
        return view('routes', compact('routes'));
    }

        public function bus_stations()
    {
        $stations = \App\Models\BusStop::paginate(25);
        return view('stations', compact('stations'));
    }
}
