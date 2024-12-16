<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function index()
    {
        $user = User::latest()->get();

        return view('pages.admin.dashboard', [
            'title' => 'Dashboard',
            'user' => $user,
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'avatar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5048',
            'name' => 'required|string|max:20',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'roles' => 'required|string|in:admin,user',
        ]);

        $user = new User();
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('avatars', $fileName, 'public');
            $user->avatar = $fileName;
        }

        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->password = Hash::make($validatedData['password']);
        $user->roles = $validatedData['roles'];

        if ($user->save()) {
            return redirect()->back()->with('success', 'User created successfully!');
        } else {
            return redirect()->back()->with('error', 'User failed to create!');
        }
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $request->validate([
            'name' => [
                'required',
                'max:20',
            ],
            'avatar' => 'image|mimes:jpg,jpeg,png,webp|max:5048',
        ], [
            'email.unique' => 'Email already taken.',
            'name.max' => 'Name is too long, maximum 20 characters.',
            'avatar.max' => 'Avatar size cannot be more than 5MB.',
        ]);
        
        $user->name = $request->input('name', $user->name);
        $user->roles = $request->input('roles', $user->roles);
        $user->status = $request->input('status', $user->status);

        if ($user->email != $request->input('email')) {
            $validatedData = $request->validate([
                'email' => 'required|email|unique:users,email',
            ]);
            $user->email = $validatedData['email'];
        }

        if ($request->filled('password')) {
            $validatedData = $request->validate([
                'password' => 'string|min:8',
            ]);
            $user->password = Hash::make($validatedData['password']);
        } else {
            $user->password = $user->getOriginal('password');
        }


        if ($request->hasFile('avatar')) {
            // Hapus file avatar lama jika ada
            if ($user->avatar) {
                Storage::disk('public')->delete('avatars/' . $user->avatar);
            }

            // Upload and update avatar
            $file = $request->file('avatar');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('avatars', $fileName, 'public');
            $user->avatar = $fileName;
        }
        $user->save();

        if ($user) {
            return redirect()->back()->with('success', 'User updated successfully!');
        } else {
            return redirect()->back()->with('error', 'User failed to update!');
        }
    }

    public function destroy($id)
    {
        $user = User::find($id);

        // Hapus avatar
        if ($user->avatar) {
            Storage::disk('public')->delete('avatars/' . $user->avatar);
        }

        // Hapus user
        $user->delete();

        if ($user) {
            return redirect()->back()->with('success', 'User deleted successfully!');
        } else {
            return redirect()->back()->with('error', 'User failed to delete!');
        }
    }

    public function deleteAvatar($id)
    {
        $user = User::find($id);

        // Hapus file avatar jika ada
        if (!empty($user->avatar)) {
            Storage::disk('public')->delete('avatars/' . $user->avatar);
            $user->avatar = null;
        }

        $user->save();
        if ($user) {
            return redirect()->back()->with('success', 'Avatar deleted!');
        } else {
            return redirect()->route('index')->with('error', 'Avatar failed to delete!');
        }
    }
}
