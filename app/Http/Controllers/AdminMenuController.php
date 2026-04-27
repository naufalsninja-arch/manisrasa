<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use Illuminate\Support\Facades\File;

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
            // Simpan ke storage/app/public/images
            $request->file('gambar')->storeAs('public/images', $imageName);
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
            $imageName = time() . '.' . $request->gambar->extension();
            // Gunakan storeAs agar konsisten dengan store
            $request->file('gambar')->storeAs('public/images', $imageName);
            $data['gambar'] = $imageName;
        } else {
            // Tetap pakai gambar lama jika tidak ada upload baru
            unset($data['gambar']);
        }

        $menu->update($data);
        return back();
    }

    public function destroy($id)
    {
        $menu = Menu::find($id);
        
        // Untuk cara storage, unlink-nya harus ke path storage jika ingin dihapus
        // Tapi ini opsional, boleh dibiarkan dulu agar tidak menambah error
        $menu->delete();
        return back();
    }
}
