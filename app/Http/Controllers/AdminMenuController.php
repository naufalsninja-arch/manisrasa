<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu; // ✅ INI WAJIB

class AdminMenuController extends Controller
{
    public function index()
    {
        $menus = Menu::all();
        return view('admin.adminmenu', compact('menus'));
    }

public function store(Request $request)
{
    $imageName = null;

    if ($request->hasFile('gambar')) {
        $imageName = time() . '.' . $request->gambar->extension();
        
        // Simpan LANGSUNG ke public/images
        $request->gambar->move(public_path('images'), $imageName);
    }

    Menu::create([
        'nama_menu' => $request->nama_menu,
        'deskripsi' => $request->deskripsi,
        'harga' => $request->harga,
        'gambar' => $imageName
    ]);

    return back();
}

    public function update(Request $request, $id)
    {
        Menu::find($id)->update($request->all());
        return back();
    }

    public function destroy($id)
    {
        Menu::find($id)->delete();
        return back();
    }
}
