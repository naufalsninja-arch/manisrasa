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
        $path = public_path('images');

        // 1. Cek apakah folder ada, jika tidak ada buat foldernya
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        // 2. PAKSA izin folder menjadi 'Bisa Ditulis' (Read/Write/Execute)
        chmod($path, 0777);

        // 3. Pindahkan filenya
        $request->gambar->move($path, $imageName);
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
    $menu = Menu::find($id);
    $data = $request->all();

    if ($request->hasFile('gambar')) {
        // 1. Buat nama file baru
        $imageName = time() . '.' . $request->gambar->extension();
        
        // 2. Pindahkan ke folder public/images
        $request->gambar->move(public_path('images'), $imageName);
        
        // 3. Masukkan nama file baru ke data yang akan diupdate
        $data['gambar'] = $imageName;
    } else {
        // Jika tidak upload gambar baru, tetap pakai gambar yang lama
        unset($data['gambar']);
    }

    $menu->update($data);
    return back();
}

    public function destroy($id)
    {
        Menu::find($id)->delete();
        return back();
    }
}
