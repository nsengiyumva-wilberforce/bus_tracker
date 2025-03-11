<?php

// app/Http/Controllers/BusController.php
namespace App\Http\Controllers;

use App\Models\Bus;
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
}
