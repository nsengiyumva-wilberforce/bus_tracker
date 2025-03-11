<?php

// app/Http/Controllers/RealTimeLocationController.php
namespace App\Http\Controllers;

use App\Models\RealTimeLocation;
use Illuminate\Http\Request;

class RealTimeLocationController extends Controller
{
    public function index()
    {
        return response()->json(RealTimeLocation::all());
    }

    public function store(Request $request)
    {
        $realTimeLocation = RealTimeLocation::create($request->all());
        return response()->json($realTimeLocation, 201);
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
