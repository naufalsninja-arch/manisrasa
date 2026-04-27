@extends('layouts.admin')

@section('content')

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
    :root {
        --primary: #4f46e5;
        --bg-main: #f8fafc;
        --text-dark: #1e293b;
        --text-muted: #64748b;
    }

    .order-container {
        font-family: 'Inter', sans-serif;
        padding: 30px;
        background: var(--bg-main);
        min-height: 100vh;
    }

    .header-flex {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
    }

    .header-flex h2 {
        font-size: 24px;
        font-weight: 700;
        color: var(--text-dark);
        margin: 0;
    }

    /* Card Wrapper */
    .table-wrapper {
        background: white;
        border-radius: 16px;
        box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05), 0 2px 4px -1px rgba(0,0,0,0.03);
        border: 1px solid #e2e8f0;
        overflow: hidden; /* Penting agar border radius terlihat */
    }

    /* Scrollable Container */
    .scroll-area {
        overflow-x: auto;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        min-width: 1200px; /* Menjaga agar kolom tidak terlalu sempit */
    }

    th {
        background: #f1f5f9;
        padding: 15px 20px;
        text-align: left;
        font-size: 12px;
        font-weight: 600;
        text-transform: uppercase;
        color: var(--text-muted);
        letter-spacing: 0.05em;
        white-space: nowrap;
    }

    td {
        padding: 16px 20px;
        border-bottom: 1px solid #f1f5f9;
        font-size: 14px;
        color: var(--text-dark);
        vertical-align: middle;
    }

    tr:hover td {
        background-color: #f8fafc;
    }

    /* Badge Status */
    .badge {
        padding: 6px 12px;
        border-radius: 99px;
        font-size: 12px;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }

    .status-diproses { background: #fffbeb; color: #92400e; } /* Kuning/Amber */
    .status-selesai { background: #ecfdf5; color: #065f46; }  /* Hijau */
    .status-diterima { background: #eff6ff; color: #1e40af; } /* Biru */

    /* Form & Button */
    .status-form {
        display: flex;
        gap: 8px;
        align-items: center;
    }

    .select-status {
        padding: 6px 10px;
        border-radius: 8px;
        border: 1px solid #cbd5e1;
        font-size: 13px;
        background: #fff;
        outline: none;
    }

    .btn-update {
        background: var(--primary);
        color: white;
        border: none;
        padding: 7px 12px;
        border-radius: 8px;
        font-size: 12px;
        font-weight: 600;
        cursor: pointer;
        transition: 0.2s;
    }

    .btn-update:hover {
        background: #4338ca;
        box-shadow: 0 4px 6px -1px rgba(79, 70, 229, 0.3);
    }

    /* Custom Scrollbar */
    .scroll-area::-webkit-scrollbar { height: 8px; }
    .scroll-area::-webkit-scrollbar-track { background: #f1f5f9; }
    .scroll-area::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
</style>

<div class="order-container">
    
    <div class="header-flex">
        <h2>📦 Data Pesanan</h2>
        <div style="color: var(--text-muted); font-size: 14px;">
            Total: <strong>{{ $orders->count() }}</strong> Pesanan
        </div>
    </div>

    <div class="table-wrapper">
        <div class="scroll-area">
            <table>
                <thead>
                    <tr>
                        <th>Pelanggan</th>
                        <th>WhatsApp</th>
                        <th>Pesanan</th>
                        <th>Varian</th>
                        <th>Qty</th>
                        <th>Waktu</th>
                        <th>Pengiriman</th>
                        <th>Status</th>
                        <th>Update Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                    <tr>
                        <td>
                            <div style="font-weight: 600; color: var(--text-dark);">{{ $order->nama }}</div>
                            <div style="font-size: 11px; color: var(--text-muted); width: 150px; line-height: 1.4; margin-top: 4px;">
                                {{ $order->alamat ?? 'Tanpa Alamat' }}
                            </div>
                        </td>

                        <td>
                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $order->whatsapp) }}" target="_blank" style="color: #25d366; text-decoration: none; font-weight: 500;">
                                💬 {{ $order->whatsapp }}
                            </a>
                        </td>

                        <td>
                            <span style="font-weight: 500;">{{ $order->produk }}</span>
                            @if($order->catatan)
                                <div style="font-size: 11px; color: #ef4444; font-style: italic;">Note: {{ $order->catatan }}</div>
                            @endif
                        </td>

                        <td><small>{{ $order->varian ?? '-' }}</small></td>

                        <td style="font-weight: 700;">{{ $order->jumlah }}</td>

                        <td>
                            <div>{{ $order->tanggal }}</div>
                            <div style="font-size: 12px; color: var(--text-muted);">{{ $order->jam }}</div>
                        </td>

                        <td>
                            <span style="font-size: 12px; padding: 4px 8px; background: #f1f5f9; border-radius: 4px; font-weight: 500;">
                                {{ $order->pengiriman }}
                            </span>
                        </td>

                        <td>
                            @if($order->status == 'diproses')
                                <span class="badge status-diproses">● Diproses</span>
                            @elseif($order->status == 'selesai')
                                <span class="badge status-selesai">● Selesai</span>
                            @elseif($order->status == 'diterima')
                                <span class="badge status-diterima">● Diterima</span>
                            @else
                                <span class="badge" style="background:#eee;">{{ $order->status }}</span>
                            @endif
                        </td>

                        <td>
                            <form action="/admin/order/update-status/{{ $order->id }}" method="POST" class="status-form">
                                @csrf
                                <select name="status" class="select-status">
                                    <option value="diproses" {{ $order->status == 'diproses' ? 'selected' : '' }}>Diproses</option>
                                    <option value="selesai" {{ $order->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                    <option value="diterima" {{ $order->status == 'diterima' ? 'selected' : '' }}>Diterima</option>
                                </select>
                                <button type="submit" class="btn-update">Update</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection