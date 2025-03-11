<?php

// app/Http/Controllers/AdminController.php
namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return response()->json(Admin::all());
    }

    public function store(Request $request)
    {
        $admin = Admin::create($request->all());
        return response()->json($admin, 201);
    }

    public function show(Admin $admin)
    {
        return response()->json($admin);
    }

    public function update(Request $request, Admin $admin)
    {
        $admin->update($request->all());
        return response()->json($admin);
    }

    public function destroy(Admin $admin)
    {
        $admin->delete();
        return response()->json(null, 204);
    }
}
