<?php

// app/Http/Controllers/RealTimeLocationController.php
namespace App\Http\Controllers;

use App\Models\RealTimeLocation;
use Illuminate\Http\Request;
use App\Events\BusLocationUpdated;


class RealTimeLocationController extends Controller
{
    public function index()
    {
        return response()->json(RealTimeLocation::all());
    }

    public function store(Request $request)
    {


        $location = RealTimeLocation::create($request->all());

        // Broadcast the update
        event(new BusLocationUpdated([
            'bus_id' => $location->bus_id,
            'latitude' => $location->latitude,
            'longitude' => $location->longitude,
            'timestamp' => $location->timestamp,
            'speed' => $location->speed,
            'direction' => $location->direction
        ]));


        return response()->json($location);
    }

    public function show(RealTimeLocation $realTimeLocation)
    {
        return response()->json($realTimeLocation);
    }

    public function update(Request $request, RealTimeLocation $realTimeLocation)
    {
        $realTimeLocation->update($request->all());
        return response()->json($realTimeLocation);
    }

    public function destroy(RealTimeLocation $realTimeLocation)
    {
        $realTimeLocation->delete();
        return response()->json(null, 204);
    }
}
