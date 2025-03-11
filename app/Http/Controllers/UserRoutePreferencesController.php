<?php

// app/Http/Controllers/UserRoutePreferencesController.php
namespace App\Http\Controllers;

use App\Models\UserRoutePreferences;
use Illuminate\Http\Request;

class UserRoutePreferencesController extends Controller
{
    public function index()
    {
        return response()->json(UserRoutePreferences::all());
    }

    public function store(Request $request)
    {
        $preferences = UserRoutePreferences::create($request->all());
        return response()->json($preferences, 201);
    }

    public function show(UserRoutePreferences $preferences)
    {
        return response()->json($preferences);
    }

    public function update(Request $request, UserRoutePreferences $preferences)
    {
        $preferences->update($request->all());
        return response()->json($preferences);
    }

    public function destroy(UserRoutePreferences $preferences)
    {
        $preferences->delete();
        return response()->json(null, 204);
    }
}
