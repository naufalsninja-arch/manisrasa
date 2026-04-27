@extends('layouts.admin')

@section('content')

@php
    use App\Models\Order;

    $diproses = Order::where('status', 'diproses')->count();
    $selesai = Order::where('status', 'selesai')->count();
    $diterima = Order::where('status', 'diterima')->count();
    $total = $diproses + $selesai + $diterima;
@endphp

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

<style>
    :root {
        --primary: #4f46e5;
        --success: #10b981;
        --warning: #f59e0b;
        --bg-body: #f8fafc;
        --card-bg: #ffffff;
        --text-main: #1e293b;
    }

    .dashboard {
        font-family: 'Inter', sans-serif;
        padding: 30px;
        background-color: var(--bg-body);
        min-height: 100vh;
    }

    .header-section {
        margin-bottom: 30px;
    }

    .title {
        font-size: 28px;
        font-weight: 700;
        color: var(--text-main);
        letter-spacing: -0.5px;
    }

    /* Stat Cards Styling */
    .stat-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }

    .stat-card {
        background: var(--card-bg);
        padding: 20px;
        border-radius: 16px;
        box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05), 0 2px 4px -1px rgba(0,0,0,0.03);
        display: flex;
        flex-direction: column;
        transition: transform 0.2s;
    }

    .stat-card:hover {
        transform: translateY(-5px);
    }

    .stat-label {
        font-size: 14px;
        color: #64748b;
        font-weight: 600;
        text-transform: uppercase;
    }

    .stat-value {
        font-size: 32px;
        font-weight: 700;
        color: var(--text-main);
        margin-top: 5px;
    }

    /* Chart Grid */
    .grid-chart {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 25px;
    }

    .chart-box {
        background: var(--card-bg);
        padding: 25px;
        border-radius: 20px;
        box-shadow: 0 10px 15px -3px rgba(0,0,0,0.05);
        border: 1px solid rgba(226, 232, 240, 0.8);
    }

    .chart-box h4 {
        font-size: 18px;
        font-weight: 600;
        margin-bottom: 20px;
        color: var(--text-main);
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .full {
        grid-column: span 2;
    }

    @media (max-width: 768px) {
        .grid-chart { grid-template-columns: 1fr; }
        .full { grid-column: span 1; }
    }
</style>

<div class="dashboard">
    
    <div class="header-section">
        <div class="title">📊 Dashboard Overview</div>
        <p style="color: #64748b;">Pantau performa pesanan Anda secara real-time.</p>
    </div>

    <div class="stat-grid">
        <div class="stat-card" style="border-left: 5px solid var(--warning);">
            <span class="stat-label">Sedang Diproses</span>
            <span class="stat-value">{{ $diproses }}</span>
        </div>
        <div class="stat-card" style="border-left: 5px solid var(--primary);">
            <span class="stat-label">Selesai</span>
            <span class="stat-value">{{ $selesai }}</span>
        </div>
        <div class="stat-card" style="border-left: 5px solid var(--success);">
            <span class="stat-label">Diterima</span>
            <span class="stat-value">{{ $diterima }}</span>
        </div>
        <div class="stat-card" style="border-left: 5px solid #6366f1;">
            <span class="stat-label">Total Order</span>
            <span class="stat-value">{{ $total }}</span>
        </div>
    </div>

    <div class="grid-chart">
        <div class="chart-box">
            <h4>🔵 Distribusi Status</h4>
            <div style="height: 300px;">
                <canvas id="chart1"></canvas>
            </div>
        </div>

        <div class="chart-box">
            <h4>🟣 Perbandingan Volume</h4>
            <div style="height: 300px;">
                <canvas id="chart2"></canvas>
            </div>
        </div>

        <div class="chart-box full">
            <h4>📈 Trend Order (7 Hari Terakhir)</h4>
            <div style="height: 350px;">
                <canvas id="chart3"></canvas>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const diproses = {{ $diproses }};
    const selesai = {{ $selesai }};
    const diterima = {{ $diterima }};

    // Color Palette
    const colors = {
        warning: '#f59e0b',
        primary: '#3b82f6',
        success: '#10b981',
        light: '#f1f5f9'
    };

    const commonOptions = {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: { position: 'bottom', labels: { padding: 20, usePointStyle: true } }
        }
    };

    // 🔵 DOUGHNUT
    new Chart(document.getElementById('chart1'), {
        type: 'doughnut',
        data: {
            labels: ['Diproses', 'Selesai', 'Diterima'],
            datasets: [{
                data: [diproses, selesai, diterima],
                backgroundColor: [colors.warning, colors.primary, colors.success],
                hoverOffset: 15,
                borderWidth: 0
            }]
        },
        options: { ...commonOptions, cutout: '70%' }
    });

    // 🟣 BAR
    new Chart(document.getElementById('chart2'), {
        type: 'bar',
        data: {
            labels: ['Diproses', 'Selesai', 'Diterima'],
            datasets: [{
                label: 'Jumlah Order',
                data: [diproses, selesai, diterima],
                backgroundColor: [colors.warning, colors.primary, colors.success],
                borderRadius: 8,
                barThickness: 40
            }]
        },
        options: {
            ...commonOptions,
            scales: {
                y: { beginAtZero: true, grid: { display: false } },
                x: { grid: { display: false } }
            }
        }
    });

    // 🟢 LINE
    new Chart(document.getElementById('chart3'), {
        type: 'line',
        data: {
            labels: ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'],
            datasets: [{
                label: 'Order Mingguan',
                data: [diproses, selesai, diterima, diproses + 2, selesai + 1, diterima + 3, {{ $total }}],
                borderColor: '#6366f1',
                backgroundColor: 'rgba(99, 102, 241, 0.1)',
                fill: true,
                tension: 0.4,
                pointRadius: 5,
                pointHoverRadius: 8
            }]
        },
        options: {
            ...commonOptions,
            scales: {
                y: { grid: { color: '#e2e8f0' } },
                x: { grid: { display: false } }
            }
        }
    });
</script>

@endsection