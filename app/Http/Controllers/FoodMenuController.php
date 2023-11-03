<?php

namespace App\Http\Controllers;

use App\Models\FoodMenu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;


class FoodMenuController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Daftar Menu Makanan',
            'food_menu' => FoodMenu::all(),
        ];
        return view('admin.food_menu.index', $data);
    }
    public function store(Request $request)
    {
        $request->validate([
            'thumbnail' => ['nullable', 'file', 'mimes:jpg,jpeg,png,bmp', 'between:0,10000'],
            'name' => ['required', 'string', 'max:191'],
            'price' => ['required', 'string', 'max:191'],
            'description' => ['nullable', 'string', 'max:191'],
        ]);

        // if ($request->hasFile('thumbnail')) {
        //     $filename = Str::random(32) . '.' . $request->file('thumbnail')->getClientOriginalExtension();
        //     $file_path = $request->file('thumbnail')->storeAs('public/uploads', $filename);
        // }
        if ($request->hasFile('thumbnail')) {
            $filename = Str::random(32) . '.' . $request->file('thumbnail')->getClientOriginalExtension();

            $image = $request->file('thumbnail');
            $path = storage_path('app/public/uploads/') . $filename;

            // Resize dan simpan gambar
            Image::make($image->getRealPath())->resize(800, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($path);

            $file_path = 'public/uploads/' . $filename;
        }

        $foods = new FoodMenu();
        $foods->name = $request->name;
        $foods->price = $request->price;
        $foods->description = $request->description;
        $foods->thumbnail = isset($file_path) ? $file_path : '';
        $foods->save();

        return redirect()->back()->with('success', 'Berhasil menambahkan menu');
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'thumbnail' => ['nullable', 'file', 'mimes:jpg,jpeg,png,bmp', 'between:0,10000'],
            'name' => ['required', 'string', 'max:191'],
            'price' => ['required', 'string', 'max:191'],
            'description' => ['nullable', 'string', 'max:191'],
        ]);
        $foods = FoodMenu::findOrFail($id);
        // if ($request->hasFile('thumbnail')) {
        //     if ($foods->thumbnail != '') {
        //         Storage::delete($foods->thumbnail);
        //     }

        //     $filename = Str::random(32) . '.' . $request->file('thumbnail')->getClientOriginalExtension();
        //     $file_path = $request->file('thumbnail')->storeAs('public/uploads', $filename);
        // }
        if ($request->hasFile('thumbnail')) {
            // Hapus gambar lama jika ada
            if ($foods->thumbnail != '') {
                Storage::delete($foods->thumbnail);
            }

            // Simpan gambar baru dengan ukuran yang lebih kecil
            $filename = Str::random(32) . '.' . $request->file('thumbnail')->getClientOriginalExtension();

            $image = $request->file('thumbnail');
            $path = storage_path('app/public/uploads/') . $filename;

            // Resize dan simpan gambar
            Image::make($image->getRealPath())->resize(800, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($path);

            $file_path = 'public/uploads/' . $filename;
        }
        $foods->name = $request->name;
        $foods->price = $request->price;
        $foods->description = $request->description;
        $foods->active = $request->active;
        $foods->thumbnail = isset($file_path) ? $file_path : $foods->thumbnail;
        $foods->save();

        return redirect()->back()->with('success', 'Berhasil mengubah menu');
    }
    public function destroy($id)
    {
        $foods = FoodMenu::findOrFail($id);
        if ($foods->thumbnail != '') {
            Storage::delete($foods->thumbnail);
        }
        $foods->delete();
        return redirect()->back()->with('success', 'Berhasil menghapus menu');
    }
}
