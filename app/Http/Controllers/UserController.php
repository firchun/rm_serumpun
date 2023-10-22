<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function akun()
    {
        $user = User::find(Auth::user()->id);
        $data = [
            'title' => 'Akun',
            'user' => $user,
        ];

        return view('admin.user.akun', $data);
    }
    public function index()
    {
        $user = User::where('role', 'admin')->get();
        $data = [
            'title' => 'Akun',
            'user' => $user,
        ];

        return view('admin.user.index', $data);
    }
    public function store(Request $request)
    {
        $request->validate([
            'avatar' => ['nullable', 'file', 'mimes:jpg,jpeg,png,bmp', 'between:0,2048'],
            'name' => ['required', 'string', 'max:191'],
            'password' => ['required', 'string', 'max:191'],
            'email' => ['required', 'email'],
            'phone' => ['required', 'string', 'max:191']
        ]);

        if ($request->hasFile('avatar')) {
            $filename = Str::random(32) . '.' . $request->file('avatar')->getClientOriginalExtension();
            $file_path = $request->file('avatar')->storeAs('public/uploads', $filename);
        }
        $user = new User;
        $user->name = $request->name;
        $user->password = Hash::make($request->password);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->role = $request->role;
        $user->avatar = isset($file_path) ? $file_path : '';
        $user->save();

        return redirect()->back()->with('success', 'Berhasil menambahkan data');
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'avatar' => ['nullable', 'file', 'mimes:jpg,jpeg,png,bmp', 'between:0,2048'],
            'name' => ['nullable', 'string', 'max:191'],
            'password' => ['nullable', 'string', 'max:191'],
            'email' => ['nullable', 'email'],
            'phone' => ['nullable', 'string', 'max:191']
        ]);

        $user = User::findOrFail($id);

        if ($request->hasFile('avatar')) {
            if ($user->avatar != '') {
                Storage::delete($user->avatar);
            }

            $filename = Str::random(32) . '.' . $request->file('avatar')->getClientOriginalExtension();
            $file_path = $request->file('avatar')->storeAs('public/uploads', $filename);
        }

        if (isset($request->password)) {
            $user->name = $request->name;
        }
        if (isset($request->password)) {
            $user->password = Hash::make($request->password);
        }
        if (isset($request->name)) {
            $user->name = $request->name;
        }
        if (isset($request->email)) {
            $user->email = $request->email;
        }
        if (isset($request->phone)) {
            $user->phone = $request->phone;
        }
        if (isset($request->role)) {
            $user->role = $request->role;
        }
        $user->avatar = isset($file_path) ? $file_path : $user->avatar;
        $user->save();

        return redirect()->back()->with('success', 'Berhasil mengubah data');
    }
    public function destroy($id)
    {
        $user = User::where('id', $id)->first();
        // Hapus user
        $user->delete();

        return redirect()->back()->with('success', 'Berhasil menghapus data');
    }
}
