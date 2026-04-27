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
            // Beri nama file unik pakai angka
            $imageName = time() . '.' . $request->gambar->extension();
            
            // Simpan ke public/images (pastikan folder ini ada di VS Code kamu)
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
        $menu = Menu::find($id);
        $data = $request->all();

        if ($request->hasFile('gambar')) {
            $imageName = time() . '.' . $request->gambar->extension();
            $request->gambar->move(public_path('images'), $imageName);
            $data['gambar'] = $imageName;
        } else {
            // Kalau tidak upload gambar baru, buang field gambar dari array update
            // Supaya data gambar lama di database tidak tertimpa/hilang
            unset($data['gambar']);
        }

        $menu->update($data);
        return back();
    }

    public function destroy($id)
    {
        $menu = Menu::find($id);
        
        // Hapus file fisik di folder kalau ada (Opsional tapi bagus buat kebersihan)
        if ($menu->gambar && file_exists(public_path('images/' . $menu->gambar))) {
            @unlink(public_path('images/' . $menu->gambar));
        }

        $menu->delete();
        return back();
    }
}
