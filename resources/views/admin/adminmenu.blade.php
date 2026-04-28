@php use Illuminate\Support\Str; @endphp

@extends('layouts.admin')

@section('content')

<!-- (CSS kamu tetap, tidak saya ubah) -->

<div class="admin-container">
    
    <div class="page-header">
        <h2>🍔 Manajemen Menu</h2>
        <button class="btn-add" onclick="openAddModal()">
            <span>+</span> Tambah Menu Baru
        </button>
    </div>

    <div class="table-card">
        <table>
            <thead>
                <tr>
                    <th>Gambar</th>
                    <th>Nama Menu</th>
                    <th>Deskripsi</th>
                    <th>Harga</th>
                    <th style="text-align: center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($menus as $menu)
                <tr>
                    <td>
                        @if($menu->gambar)

                            {{-- ✅ FIX UTAMA DI SINI --}}
                            @if(Str::startsWith($menu->gambar, 'http'))
                                <img src="{{ $menu->gambar }}" class="img-preview">
                            @else
                                <img src="{{ asset('storage/images/'.$menu->gambar) }}" class="img-preview">
                            @endif

                        @else
                            <div class="img-preview" style="background:#f1f5f9; display:flex; align-items:center; justify-content:center; color:#cbd5e1;">
                                NO IMG
                            </div>
                        @endif
                    </td>

                    <td><strong>{{ $menu->nama_menu }}</strong></td>

                    <td style="font-size: 14px;">
                        {{ Str::limit($menu->deskripsi, 50) }}
                    </td>

                    <td>
                        <span class="price-tag">
                            Rp {{ number_format($menu->harga, 0, ',', '.') }}
                        </span>
                    </td>

                    <td style="text-align: center;">
                        <button class="btn-edit" onclick='openEditModal(@json($menu))'>Edit</button>

                        <a href="/admin/menu/delete/{{ $menu->id }}" 
                           class="btn-delete" 
                           onclick="return confirm('Yakin hapus menu ini?')">
                           Hapus
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- MODAL (TIDAK PERLU DIUBAH) -->
<div id="addModal" class="modal-overlay">
    <div class="modal-content">
        <h3>✨ Tambah Menu Baru</h3>
        <form action="/admin/menu/store" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label>Nama Menu</label>
                <input type="text" name="nama_menu" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Deskripsi</label>
                <textarea name="deskripsi" class="form-control"></textarea>
            </div>

            <div class="form-group">
                <label>Harga</label>
                <input type="number" name="harga" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Gambar</label>
                <input type="file" name="gambar" class="form-control">
            </div>

            <div class="modal-actions">
                <button type="button" onclick="closeAddModal()">Batal</button>
                <button type="submit">Simpan</button>
            </div>
        </form>
    </div>
</div>

<div id="editModal" class="modal-overlay">
    <div class="modal-content">
        <h3>Edit Menu</h3>
        <form id="editForm" method="POST" enctype="multipart/form-data">
            @csrf

            <input type="text" name="nama_menu" id="editNama" class="form-control">
            <textarea name="deskripsi" id="editDeskripsi" class="form-control"></textarea>
            <input type="number" name="harga" id="editHarga" class="form-control">

            <input type="file" name="gambar" class="form-control">

            <button type="submit">Update</button>
        </form>
    </div>
</div>

<script>
function openAddModal() {
    document.getElementById('addModal').style.display = 'flex';
}
function closeAddModal() {
    document.getElementById('addModal').style.display = 'none';
}

function openEditModal(menu) {
    document.getElementById('editModal').style.display = 'flex';
    document.getElementById('editNama').value = menu.nama_menu;
    document.getElementById('editDeskripsi').value = menu.deskripsi;
    document.getElementById('editHarga').value = menu.harga;
    document.getElementById('editForm').action = '/admin/menu/update/' + menu.id;
}
</script>

@endsection
