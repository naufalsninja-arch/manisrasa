@extends('layouts.app')

@section('content')

<style>
    .menu-container {
        padding: 40px;
    }

    .menu-title {
        text-align: center;
        margin-bottom: 30px;
        font-size: 28px;
        font-weight: bold;
    }

    .menu-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 25px;
    }

    .menu-card {
        border: 1px solid #eee;
        padding: 16px;
        border-radius: 16px;
        text-align: center;
        background: #fff;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        transition: 0.3s;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .menu-card:hover {
        transform: translateY(-6px);
    }

    .menu-card img {
        width: 100%;
        height: 170px;
        object-fit: cover;
        border-radius: 12px;
        margin-bottom: 12px;
    }

    .menu-card h3 {
        margin-bottom: 6px;
        font-size: 18px;
    }

    .menu-card p {
        font-size: 14px;
        color: #555;
        min-height: 40px;
    }

    .price {
        margin-top: 10px;
        font-size: 16px;
        font-weight: bold;
        color: #e91e63;
    }

    .btn-order {
        margin-top: 15px;
        padding: 10px;
        background: #e91e63;
        color: white;
        border-radius: 10px;
        text-decoration: none;
        display: inline-block;
        transition: 0.3s;
    }

    .btn-order:hover {
        background: #c2185b;
        transform: scale(1.05);
    }

    /* Responsive */
    @media (max-width: 768px) {
        .menu-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 480px) {
        .menu-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="menu-container">
    
    <h1 class="menu-title">🍰 Daftar Menu Manis Rasa</h1>

    <div class="menu-grid">

        @foreach($menus as $menu)
        <div class="menu-card">

            <!-- GAMBAR -->
            @if($menu->gambar)
                <img src="{{ asset('images/'.$menu->gambar) }}" alt="{{ $menu->nama_menu }}">
            @else
                <img src="https://via.placeholder.com/300x200?text=No+Image">
            @endif

            <!-- INFO -->
            <h3>{{ $menu->nama_menu }}</h3>
            <p>{{ $menu->deskripsi }}</p>

            <!-- HARGA -->
            <div class="price">
                Rp {{ number_format($menu->harga) }}
            </div>

            <!-- BUTTON -->
            <a href="/order?produk={{ urlencode($menu->nama_menu) }}" class="btn-order">
                Order Sekarang
            </a>

        </div>
        @endforeach

    </div>

</div>

@endsection