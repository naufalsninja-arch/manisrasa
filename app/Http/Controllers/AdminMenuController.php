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
            // Simpan langsung ke public/images (Konsisten)
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
            // SAMAKAN: Pakai move ke public/images, jangan storeAs
            $request->gambar->move(public_path('images'), $imageName);
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
        
        // Hapus file di folder public/images agar tidak menumpuk (Opsional)
        if ($menu->gambar && file_exists(public_path('images/' . $menu->gambar))) {
            @unlink(public_path('images/' . $menu->gambar));
        }

        $menu->delete();
        return back();
    }
}
