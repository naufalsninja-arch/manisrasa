@extends('layouts.app')

@section('content')

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

<style>
    body {
        background-color: #f8f9fa;
        font-family: 'Inter', sans-serif;
    }

    .order-container {
        max-width: 600px;
        margin: 0 auto;
        padding: 60px 20px;
    }

    .order-title {
        text-align: center;
        font-size: 2rem;
        font-weight: 800;
        color: #1a1a1a;
        margin-bottom: 8px;
    }

    .order-subtitle {
        text-align: center;
        color: #6c757d;
        margin-bottom: 40px;
        font-size: 1rem;
    }

    .order-form {
        background: #ffffff;
        padding: 40px;
        border-radius: 20px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.05);
        border: 1px solid #f1f1f1;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-label {
        display: block;
        font-weight: 600;
        margin-bottom: 8px;
        color: #444;
        font-size: 0.9rem;
    }

    .order-form input,
    .order-form select,
    .order-form textarea {
        width: 100%;
        padding: 12px 16px;
        border: 1.5px solid #e0e0e0;
        border-radius: 10px;
        font-size: 1rem;
        transition: all 0.3s ease;
        box-sizing: border-box;
        background-color: #fafafa;
    }

    .order-form input:focus,
    .order-form select:focus,
    .order-form textarea:focus {
        outline: none;
        border-color: #e91e63;
        background-color: #fff;
        box-shadow: 0 0 0 4px rgba(233, 30, 99, 0.1);
    }

    .btn-order {
        width: 100%;
        padding: 15px;
        background: linear-gradient(135deg, #e91e63 0%, #c2185b 100%);
        color: white;
        border: none;
        border-radius: 12px;
        font-weight: 700;
        font-size: 1rem;
        cursor: pointer;
        transition: transform 0.2s, box-shadow 0.2s;
        margin-top: 10px;
    }

    .btn-order:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(233, 30, 99, 0.3);
    }

    .btn-order:active {
        transform: translateY(0);
    }

    /* MODAL STYLING */
    .modal {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.6);
        backdrop-filter: blur(4px);
        display: none;
        justify-content: center;
        align-items: center;
        z-index: 1000;
    }

    .modal-content {
        background: white;
        padding: 40px;
        border-radius: 24px;
        text-align: center;
        width: 90%;
        max-width: 400px;
        animation: slideUp 0.3s ease-out;
    }

    @keyframes slideUp {
        from { transform: translateY(20px); opacity: 0; }
        to { transform: translateY(0); opacity: 1; }
    }

    .modal-content h2 {
        margin-bottom: 15px;
        font-size: 1.5rem;
        color: #1a1a1a;
    }

    .modal-content p {
        color: #636e72;
        line-height: 1.6;
        margin-bottom: 30px;
    }

    .modal-buttons {
        display: flex;
        gap: 12px;
    }

    .modal-buttons button {
        flex: 1;
        padding: 12px;
        border-radius: 10px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s;
        border: none;
    }

    .btn-skip {
        background: #f1f2f6;
        color: #2f3542;
    }

    .btn-skip:hover {
        background: #dfe4ea;
    }

    .wa-btn {
        background: #25D366;
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }

    .wa-btn:hover {
        background: #1eb954;
        box-shadow: 0 4px 12px rgba(37, 211, 102, 0.3);
    }
</style>

<div class="order-container">
    <h1 class="order-title">Form Pemesanan</h1>
    <p class="order-subtitle">Lengkapi detail pesanan Anda di bawah ini</p>

    <div class="order-form">
        <form id="orderForm" action="/order/store" method="POST">
            @csrf
            <input type="hidden" name="action" id="actionType">

            <div class="form-group">
                <label class="form-label">Nama Lengkap</label>
                <input type="text" name="nama" placeholder="Contoh: Budi Santoso" required>
            </div>

            <div class="form-group">
                <label class="form-label">Nomor WhatsApp</label>
                <input type="text" name="whatsapp" placeholder="0812xxxx" required>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                <div class="form-group">
                    <label class="form-label">Produk</label>
                    <input type="text" name="produk" placeholder="Nama Produk" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Varian</label>
                    <input type="text" name="varian" placeholder="Rasa/Warna">
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Jumlah</label>
                <input type="number" name="jumlah" placeholder="0" required>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                <div class="form-group">
                    <label class="form-label">Tanggal</label>
                    <input type="date" name="tanggal" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Jam</label>
                    <input type="time" name="jam" required>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Metode Pengiriman</label>
                <select name="pengiriman" required>
                    <option value="">-- Pilih Pengiriman --</option>
                    <option value="jemput_toko">🏪 Jemput di Toko</option>
                    <option value="delivery">🛵 Delivery</option>
                </select>
            </div>

            <div class="form-group">
                <label class="form-label">Alamat Lengkap</label>
                <textarea name="alamat" rows="3" placeholder="Masukkan alamat pengiriman..."></textarea>
            </div>

            <div class="form-group">
                <label class="form-label">Catatan Tambahan</label>
                <textarea name="catatan" rows="2" placeholder="Contoh: Jangan terlalu pedas"></textarea>
            </div>

            <button type="button" class="btn-order" onclick="openModal()">
                Konfirmasi Pesanan
            </button>
        </form>
    </div>
</div>

<div id="orderModal" class="modal">
    <div class="modal-content">
        <div style="font-size: 50px; margin-bottom: 10px;">🎉</div>
        <h2>Pesanan Siap!</h2>
        <p>Satu langkah lagi! Kirim rincian pesanan Anda ke WhatsApp untuk respon lebih cepat.</p>

        <div class="modal-buttons">
            <button type="button" class="btn-skip" onclick="goHome()">Hanya Simpan</button>
            <button type="button" class="wa-btn" onclick="submitWA()">
                <span>Kirim WA</span>
            </button>
        </div>
    </div>
</div>

<script>
function openModal() {
    document.getElementById('orderModal').style.display = 'flex';
}

function submitWA() {
    document.getElementById('actionType').value = 'wa';
    document.getElementById('orderForm').submit();
}

function goHome() {
    document.getElementById('actionType').value = 'home';
    document.getElementById('orderForm').submit();
}

// Menutup modal jika klik di luar area konten
window.onclick = function(event) {
    let modal = document.getElementById('orderModal');
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>

@endsection