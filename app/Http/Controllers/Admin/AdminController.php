<?php
// app/Http/Controllers/AdminController.php
namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use App\Http\Controllers\Controller;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        $admins = Admin::with('user')->paginate(10);
        return view('admins.index', compact('admins'));
    }

    public function create()
    {
        return view('admins.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'username' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:8',
            'phone_number' => 'nullable|string|max:15',
            'role' => 'required|in:SuperAdmin,Admin'
        ]);

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'phone_number' => $request->phone_number
        ]);

        Admin::create([
            'user_id' => $user->id,
            'role' => $request->role
        ]);

        return redirect()->route('admins.index')
            ->with('success', 'Admin user created successfully.');
    }

    public function show(Admin $admin)
    {
        return view('admins.show', compact('admin'));
    }

    public function edit(Admin $admin)
    {
        return view('admins.edit', compact('admin'));
    }

    public function update(Request $request, Admin $admin)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$admin->user_id,
            'username' => 'required|string|max:255|unique:users,username,'.$admin->user_id,
            'password' => 'nullable|string|min:8|confirmed',
            'phone_number' => 'nullable|string|max:15',
            'role' => 'required|in:SuperAdmin,Admin'
        ]);

        $userData = [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'username' => $request->username,
            'phone_number' => $request->phone_number
        ];

        if ($request->password) {
            $userData['password'] = Hash::make($request->password);
        }

        $admin->user->update($userData);
        $admin->update(['role' => $request->role]);

        return redirect()->route('admins.index')
            ->with('success', 'Admin user updated successfully');
    }

    public function destroy(Admin $admin)
    {
        $admin->delete();
        return redirect()->route('admins.index')
            ->with('success', 'Admin deleted successfully');
    }
}