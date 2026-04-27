@extends('layouts.admin')

@section('content')

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
    :root {
        --primary: #4f46e5;
        --primary-hover: #4338ca;
        --danger: #ef4444;
        --danger-hover: #dc2626;
        --success: #10b981;
        --bg-main: #f8fafc;
        --text-dark: #1e293b;
        --text-muted: #64748b;
    }

    .admin-container {
        font-family: 'Inter', sans-serif;
        padding: 30px;
        background: var(--bg-main);
        min-height: 100vh;
    }

    /* Header Styling */
    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
    }

    .page-header h2 {
        font-size: 24px;
        font-weight: 700;
        color: var(--text-dark);
        margin: 0;
    }

    .btn-add {
        background: var(--primary);
        color: white;
        padding: 10px 20px;
        border-radius: 10px;
        border: none;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
        display: flex;
        align-items: center;
        gap: 8px;
        box-shadow: 0 4px 6px -1px rgba(79, 70, 229, 0.2);
    }

    .btn-add:hover {
        background: var(--primary-hover);
        transform: translateY(-2px);
    }

    /* Table Styling */
    .table-card {
        background: white;
        border-radius: 16px;
        box-shadow: 0 10px 15px -3px rgba(0,0,0,0.05);
        overflow: hidden;
        border: 1px solid #e2e8f0;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        text-align: left;
    }

    th {
        background: #f1f5f9;
        padding: 15px 20px;
        color: var(--text-muted);
        font-weight: 600;
        font-size: 13px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    td {
        padding: 18px 20px;
        border-bottom: 1px solid #f1f5f9;
        color: var(--text-dark);
        vertical-align: middle;
    }

    tr:last-child td { border-bottom: none; }

    .img-preview {
        width: 60px;
        height: 60px;
        object-fit: cover;
        border-radius: 10px;
        border: 2px solid #f1f5f9;
    }

    .price-tag {
        font-weight: 700;
        color: var(--primary);
    }

    /* Action Buttons */
    .btn-edit {
        background: #f1f5f9;
        color: var(--text-dark);
        padding: 6px 12px;
        border-radius: 6px;
        border: none;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        margin-right: 5px;
        transition: 0.2s;
    }

    .btn-edit:hover { background: #e2e8f0; }

    .btn-delete {
        background: #fff1f2;
        color: var(--danger);
        padding: 6px 12px;
        border-radius: 6px;
        text-decoration: none;
        font-size: 13px;
        font-weight: 600;
        transition: 0.2s;
    }

    .btn-delete:hover { background: #ffe4e6; }

    /* Modal Styling */
    .modal-overlay {
        display: none;
        position: fixed;
        top: 0; left: 0; width: 100%; height: 100%;
        background: rgba(15, 23, 42, 0.6);
        backdrop-filter: blur(4px);
        justify-content: center;
        align-items: center;
        z-index: 999;
    }

    .modal-content {
        background: white;
        padding: 30px;
        border-radius: 20px;
        width: 100%;
        max-width: 450px;
        box-shadow: 0 20px 25px -5px rgba(0,0,0,0.1);
    }

    .modal-content h3 {
        margin-top: 0;
        margin-bottom: 20px;
        font-weight: 700;
        color: var(--text-dark);
    }

    .form-group { margin-bottom: 15px; }

    .form-group label {
        display: block;
        margin-bottom: 5px;
        font-size: 14px;
        font-weight: 600;
        color: var(--text-muted);
    }

    .form-control {
        width: 100%;
        padding: 10px 12px;
        border-radius: 8px;
        border: 1px solid #cbd5e1;
        font-family: inherit;
        box-sizing: border-box;
    }

    .form-control:focus {
        outline: 2px solid #c7d2fe;
        border-color: var(--primary);
    }

    .modal-actions {
        display: flex;
        gap: 10px;
        margin-top: 25px;
    }

    .btn-save {
        flex: 1;
        background: var(--primary);
        color: white;
        border: none;
        padding: 12px;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
    }

    .btn-cancel {
        flex: 1;
        background: #f1f5f9;
        color: var(--text-muted);
        border: none;
        padding: 12px;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
    }
</style>

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
                            <img src="{{ asset('images/'.$menu->gambar) }}" class="img-preview">
                        @else
                            <div class="img-preview" style="background:#f1f5f9; display:flex; align-items:center; justify-content:center; color:#cbd5e1;">NO IMG</div>
                        @endif
                    </td>
                    <td><strong style="color: var(--text-dark);">{{ $menu->nama_menu }}</strong></td>
                    <td style="color: var(--text-muted); font-size: 14px;">{{ Str::limit($menu->deskripsi, 50) }}</td>
                    <td><span class="price-tag">Rp {{ number_format($menu->harga, 0, ',', '.') }}</span></td>
                    <td style="text-align: center;">
                        <button class="btn-edit" onclick='openEditModal(@json($menu))'>Edit</button>
                        <a href="/admin/menu/delete/{{ $menu->id }}" class="btn-delete" onclick="return confirm('Yakin hapus menu ini?')">Hapus</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div id="addModal" class="modal-overlay">
    <div class="modal-content">
        <h3>✨ Tambah Menu Baru</h3>
        <form action="/admin/menu/store" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label>Nama Menu</label>
                <input type="text" name="nama_menu" class="form-control" placeholder="Contoh: Nasi Goreng Spesial" required>
            </div>
            <div class="form-group">
                <label>Deskripsi</label>
                <textarea name="deskripsi" class="form-control" rows="3" placeholder="Jelaskan kelezatan menu ini..."></textarea>
            </div>
            <div class="form-group">
                <label>Harga (Rp)</label>
                <input type="number" name="harga" class="form-control" placeholder="35000" required>
            </div>
            <div class="form-group">
                <label>Gambar Menu</label>
                <input type="file" name="gambar" class="form-control">
            </div>
            <div class="modal-actions">
                <button type="button" class="btn-cancel" onclick="closeAddModal()">Batal</button>
                <button type="submit" class="btn-save">Simpan Menu</button>
            </div>
        </form>
    </div>
</div>

<div id="editModal" class="modal-overlay">
    <div class="modal-content">
        <h3>✏️ Edit Detail Menu</h3>
        <form id="editForm" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label>Nama Menu</label>
                <input type="text" name="nama_menu" id="editNama" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Deskripsi</label>
                <textarea name="deskripsi" id="editDeskripsi" class="form-control" rows="3"></textarea>
            </div>
            <div class="form-group">
                <label>Harga (Rp)</label>
                <input type="number" name="harga" id="editHarga" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Ganti Gambar (Opsional)</label>
                <input type="file" name="gambar" class="form-control">
            </div>
            <div class="modal-actions">
                <button type="button" class="btn-cancel" onclick="closeEditModal()">Batal</button>
                <button type="submit" class="btn-save">Update Menu</button>
            </div>
        </form>
    </div>
</div>

<script>
    function openAddModal() { document.getElementById('addModal').style.display = 'flex'; }
    function closeAddModal() { document.getElementById('addModal').style.display = 'none'; }

    function openEditModal(menu) {
        document.getElementById('editModal').style.display = 'flex';
        document.getElementById('editNama').value = menu.nama_menu;
        document.getElementById('editDeskripsi').value = menu.deskripsi;
        document.getElementById('editHarga').value = menu.harga;
        document.getElementById('editForm').action = '/admin/menu/update/' + menu.id;
    }

    function closeEditModal() { document.getElementById('editModal').style.display = 'none'; }

    // Close modal if user clicks outside of it
    window.onclick = function(event) {
        if (event.target.classList.contains('modal-overlay')) {
            closeAddModal();
            closeEditModal();
        }
    }
</script>

@endsection
