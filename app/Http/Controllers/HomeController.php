<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('pages.index', [
            'title' => 'Home - Superior Auth',
        ]);
    }

    public function update_profile(Request $request, $id)
    {
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


        // Cek apakah pengguna yang terautentikasi adalah pemilik dari data yang ingin diperbarui
        if (Auth::id() !== (int) $id) {
            return redirect()->route('index')->with('error', 'Oops, something wrong here!');
        }
    
        $user = User::find($id);
        if (!$user) {
            return redirect()->route('index')->with('error', 'User not found!');
        }

        $user->name = $request->input('name', $user->name);
        $user->email = $request->input('email', $user->email);
        $user->avatar = $request->input('avatar', $user->avatar);

        if ($request->filled('password')) {
            $validatedData = $request->validate([
                'password' => 'string|min:8',
            ]);
            $user->password = Hash::make($validatedData['password']);
        } else {
            $user->password = $user->getOriginal('password');
        }

        if ($request->hasFile('avatar')) {
            // Hapus avatar lama jika ada
            if ($user->avatar) {
                Storage::disk('public')->delete('avatars/' . $user->avatar);
            }

            // Simpan avatar baru
            $file = $request->file('avatar');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('avatars', $fileName, 'public');
            $user->avatar = $fileName;
        }

        $user->save();
        if ($user) {
            return redirect()->route('index')->with('success', 'Profile edited successfully!');
        } else {
            return redirect()->route('index')->with('error', 'Profile edit failed!');
        }
    }


    public function deleteAvatar($id)
    {
        // Cek apakah pengguna yang terautentikasi adalah pemilik dari data yang ingin diperbarui
        if (Auth::id() !== (int) $id) {
            return redirect()->route('index')->with('error', 'Oops, something wrong here!');
        }
    
        $user = User::find($id);
        if (!$user) {
            return redirect()->route('index')->with('error', 'User not found!');
        }

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
