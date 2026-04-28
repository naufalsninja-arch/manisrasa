<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    // ================= USER =================
    public function index()
    {
        return view('order');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'whatsapp' => 'required',
            'produk' => 'required|string',
            'jumlah' => 'required|numeric',
            'tanggal' => 'required|date',
            'jam' => 'required',
            'pengiriman' => 'required|string',
        ]);

        // 🔥 LOGIKA GERILYA: Hitung ID secara manual karena TiDB Auto Increment bermasalah
        $lastOrder = Order::orderBy('id', 'desc')->first();
        $newId = $lastOrder ? $lastOrder->id + 1 : 1;

        // ✅ SIMPAN KE DATABASE DENGAN ID MANUAL
        Order::create([
            'id' => $newId, // Memberikan ID manual agar tidak error di TiDB
            'nama' => $request->nama,
            'whatsapp' => $request->whatsapp,
            'produk' => $request->produk,
            'varian' => $request->varian,
            'jumlah' => $request->jumlah,
            'tanggal' => $request->tanggal,
            'jam' => $request->jam,
            'pengiriman' => $request->pengiriman,
            'alamat' => $request->alamat,
            'catatan' => $request->catatan,
            'status' => 'diproses'
        ]);

        // FORMAT NOMOR WA UNTUK REDIRECT
        $no = preg_replace('/[^0-9]/', '', $request->whatsapp);
        if (substr($no, 0, 1) == "0") {
            $no = "62" . substr($no, 1);
        }

        // PESAN WA
        $pesan = urlencode(
            "Halo Manis Rasa 🍰\n\n" .
            "Nama: {$request->nama}\n" .
            "Produk: {$request->produk}\n" .
            "Jumlah: {$request->jumlah}"
        );

        // Redirect ke WhatsApp jika tombol yang diklik adalah 'wa'
        if ($request->action == 'wa') {
            return redirect("https://wa.me/628124124?text=$pesan");
        }

        return redirect('/')->with('success', 'Pesanan berhasil disimpan!');
    }

    // ================= ADMIN =================
    public function adminIndex()
    {
        $orders = Order::latest()->get();
        return view('admin.adminorder', compact('orders'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required'
        ]);

        $order = Order::findOrFail($id);
        $order->status = $request->status;
        $order->save();

        return back();
    }

    public function cekOrder()
    {
        return view('cek-order');
    }

    public function cariOrder(Request $request)
    {
        $orders = Order::where('whatsapp', $request->whatsapp)->get();
        return view('cek-order', compact('orders'));
    }
}
