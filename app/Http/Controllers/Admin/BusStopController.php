<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BusStop;
use Illuminate\Http\Request;

class BusStopController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $busStops = BusStop::latest()->paginate(10);
        return view('pages.bus-stops.index', compact('busStops'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.bus-stops.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180'
        ]);

        BusStop::create($validated);

        return redirect()->route('bus-stops.index')
            ->with('success', 'Bus stop created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $busStop = BusStop::findOrFail($id);
        return view('pages.bus-stops.show', compact('busStop'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BusStop $busStop)
    {
        return view('pages.bus-stops.edit', compact('busStop'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $busStop = BusStop::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180'
        ]);

        $busStop->update($validated);

        return redirect()->route('bus-stops.index')
            ->with('success', 'Bus stop updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $busStop = BusStop::findOrFail($id);
        $busStop->delete();

        return redirect()->route('bus-stops.index')
            ->with('success', 'Bus stop deleted successfully');
    }
}