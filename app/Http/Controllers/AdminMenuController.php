<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use Cloudinary\Cloudinary;

class AdminMenuController extends Controller
{
    protected $cloudinary;

    // 🔧 Constructor biar tidak bikin object berulang
    public function __construct()
    {
        $this->cloudinary = new Cloudinary(env('CLOUDINARY_URL'));
    }

    public function index()
    {
        $menus = Menu::all();
        return view('admin.adminmenu', compact('menus'));
    }

    // 🚀 STORE (Tambah menu)
    public function store(Request $request)
    {
        $request->validate([
            'nama_menu' => 'required',
            'harga' => 'required',
            'gambar' => 'required|image|max:2048'
        ]);

        $imageUrl = null;

        if ($request->hasFile('gambar')) {
            $result = $this->cloudinary->uploadApi()->upload(
                $request->file('gambar')->getRealPath()
            );

            $imageUrl = $result['secure_url'];
        }

        Menu::create([
            'nama_menu' => $request->nama_menu,
            'deskripsi' => $request->deskripsi,
            'harga' => $request->harga,
            'gambar' => $imageUrl
        ]);

        return back()->with('success', 'Menu berhasil ditambahkan');
    }

    // ✏️ UPDATE
    public function update(Request $request, $id)
    {
        $menu = Menu::findOrFail($id);

        $data = $request->only(['nama_menu', 'deskripsi', 'harga']);

        if ($request->hasFile('gambar')) {
            $result = $this->cloudinary->uploadApi()->upload(
                $request->file('gambar')->getRealPath()
            );

            $data['gambar'] = $result['secure_url'];
        }

        $menu->update($data);

        return back()->with('success', 'Menu berhasil diupdate');
    }

    // 🗑️ DELETE
    public function destroy($id)
    {
        $menu = Menu::findOrFail($id);

        // ❌ Tidak perlu unlink lagi (bukan file lokal)
        // Kalau mau advanced: bisa delete dari Cloudinary juga

        $menu->delete();

        return back()->with('success', 'Menu berhasil dihapus');
    }
}
