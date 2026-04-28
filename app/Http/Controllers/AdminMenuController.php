<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use Cloudinary\Cloudinary;

class AdminMenuController extends Controller
{
    protected $cloudinary;

    public function __construct()
    {
        $this->cloudinary = new Cloudinary(env('CLOUDINARY_URL'));
    }

    public function index()
    {
        // Optional: terbaru di atas
        $menus = Menu::latest()->get();
        return view('admin.adminmenu', compact('menus'));
    }

    // 🚀 STORE
    public function store(Request $request)
    {
        $request->validate([
            'nama_menu' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'harga' => 'required|numeric',
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

        // 🔥 VALIDASI (ini yang sebelumnya kurang)
        $request->validate([
            'nama_menu' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'harga' => 'required|numeric',
            'gambar' => 'nullable|image|max:2048'
        ]);

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

        // (Optional) Kalau mau hapus dari Cloudinary juga bisa nanti

        $menu->delete();

        return back()->with('success', 'Menu berhasil dihapus');
    }
}
