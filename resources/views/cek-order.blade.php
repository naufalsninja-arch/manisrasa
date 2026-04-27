@extends('layouts.app')

@section('content')

<div style="max-width:700px; margin:auto; padding:40px;">

    <h2 style="text-align:center; margin-bottom:20px;">
        🔍 Cek Status Pesanan
    </h2>

    <!-- FORM CARI -->
    <form method="POST" action="/cek-order" style="text-align:center;">
        @csrf

        <input type="text" name="whatsapp" 
               placeholder="Masukkan Nomor WhatsApp"
               style="padding:10px; width:70%; border:1px solid #ccc; border-radius:8px;">

        <button type="submit"
                style="padding:10px 15px; background:#e91e63; color:white; border:none; border-radius:8px;">
            Cek
        </button>
    </form>

    <br>

    <!-- HASIL -->
    @if(isset($orders))
        @if($orders->count() > 0)

            @foreach($orders as $order)
                <div style="border:1px solid #ddd; padding:15px; border-radius:10px; margin-bottom:10px;">

                    <p><b>Produk:</b> {{ $order->produk }}</p>
                    <p><b>Jumlah:</b> {{ $order->jumlah }}</p>
                    <p><b>Tanggal:</b> {{ $order->tanggal }}</p>

                    <p><b>Status:</b> 
                        @if($order->status == 'diproses')
                            <span style="color:orange;">🟡 Diproses</span>
                        @elseif($order->status == 'selesai')
                            <span style="color:green;">🟢 Selesai</span>
                        @elseif($order->status == 'diterima')
                            <span style="color:blue;">🔵 Diterima</span>
                        @endif
                    </p>

                </div>
            @endforeach

        @else
            <p style="text-align:center; color:red;">
                ❌ Pesanan tidak ditemukan
            </p>
        @endif
    @endif

</div>

@endsection