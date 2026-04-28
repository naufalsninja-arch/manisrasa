<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use Cloudinary\Cloudinary;
use Exception;

class AdminMenuController extends Controller
{
    protected $cloudinary;

    public function __construct()
    {
        // Pastikan CLOUDINARY_URL sudah di-set di Dashboard Render (Environment Variables)
        $this->cloudinary = new Cloudinary(env('CLOUDINARY_URL'));
    }

    public function index()
    {
        $menus = Menu::latest()->get();
        return view('admin.adminmenu', compact('menus'));
    }

    // 🚀 STORE (Tambah Menu)
    public function store(Request $request)
    {
        $request->validate([
            'nama_menu' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'harga'     => 'required|numeric',
            'gambar'    => 'required|image|mimes:jpg,jpeg,png,webp|max:2048' // Validasi mimes lebih aman
        ]);

        $imageUrl = null;

        if ($request->hasFile('gambar')) {
            try {
                // Menggunakan path() seringkali lebih stabil di environment server Linux/Render
                $result = $this->cloudinary->uploadApi()->upload(
                    $request->file('gambar')->path(),
                    [
                        'folder' => 'restoran_menu', // Mengelompokkan gambar di Cloudinary
                        'resource_type' => 'auto'
                    ]
                );

                $imageUrl = $result['secure_url'];
            } catch (Exception $e) {
                // Jika Cloudinary gagal, balikkan error detailnya
                return back()->withErrors(['gambar' => 'Cloudinary Upload Gagal: ' . $e->getMessage()])->withInput();
            }
        }

        Menu::create([
            'nama_menu' => $request->nama_menu,
            'deskripsi' => $request->deskripsi,
            'harga'     => $request->harga,
            'gambar'    => $imageUrl
        ]);

        return back()->with('success', 'Menu berhasil ditambahkan!');
    }

    // ✏️ UPDATE (Edit Menu)
    public function update(Request $request, $id)
    {
        $menu = Menu::findOrFail($id);

        $request->validate([
            'nama_menu' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'harga'     => 'required|numeric',
            'gambar'    => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048'
        ]);

        $data = $request->only(['nama_menu', 'deskripsi', 'harga']);

        if ($request->hasFile('gambar')) {
            try {
                $result = $this->cloudinary->uploadApi()->upload(
                    $request->file('gambar')->path(),
                    [
                        'folder' => 'restoran_menu',
                        'resource_type' => 'auto'
                    ]
                );

                $data['gambar'] = $result['secure_url'];
            } catch (Exception $e) {
                return back()->withErrors(['gambar' => 'Gagal update gambar ke Cloudinary: ' . $e->getMessage()]);
            }
        }

        $menu->update($data);

        return back()->with('success', 'Menu berhasil diupdate!');
    }

    // 🗑️ DELETE (Hapus Menu)
    public function destroy($id)
    {
        $menu = Menu::findOrFail($id);

        // Hapus data dari database
        $menu->delete();

        return back()->with('success', 'Menu berhasil dihapus!');
    }
}
