<?php

// app/Http/Controllers/BusStopController.php
namespace App\Http\Controllers;

use App\Models\BusStop;
use Illuminate\Http\Request;

class BusStopController extends Controller
{
    public function index()
    {
        return response()->json(BusStop::all());
    }

    public function store(Request $request)
    {
        $busStop = BusStop::create($request->all());
        return response()->json($busStop, 201);
    }

    public function show(BusStop $busStop)
    {
        return response()->json($busStop);
    }

    public function update(Request $request, BusStop $busStop)
    {
        $busStop->update($request->all());
        return response()->json($busStop);
    }

    public function destroy(BusStop $busStop)
    {
        $busStop->delete();
        return response()->json(null, 204);
    }
}
