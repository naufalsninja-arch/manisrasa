@extends('layouts.app')

@section('content')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
<link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;600;700&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">

<style>
    .about-section {
        font-family: 'Quicksand', sans-serif;
        background: #fff;
        padding-bottom: 80px;
    }

    /* SLIDER STYLING */
    .hero-slider {
        width: 100%;
        height: 500px;
        position: relative;
        overflow: hidden;
        margin-bottom: 60px;
    }

    .swiper-slide img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .slider-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.3);
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        color: white;
        text-align: center;
        padding: 20px;
    }

    .slider-title {
        font-family: 'Playfair Display', serif;
        font-size: 52px;
        text-shadow: 2px 2px 10px rgba(0,0,0,0.5);
    }

    /* CONTENT STYLING */
    .about-container {
        max-width: 1100px;
        margin: 0 auto;
        text-align: center;
        padding: 0 20px;
    }

    .about-title-main {
        font-family: 'Playfair Display', serif;
        font-size: 42px;
        color: #d81b60;
        margin-bottom: 20px;
    }

    .about-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 30px;
        margin-top: 50px;
    }

    .card-feature {
        background: #ffffff;
        border-radius: 24px;
        box-shadow: 0 10px 30px rgba(216, 27, 96, 0.05);
        border: 1px solid #fce4ec;
        transition: all 0.3s ease;
        overflow: hidden;
        display: flex;
        flex-direction: column;
    }

    .card-feature:hover {
        transform: translateY(-12px);
        box-shadow: 0 15px 45px rgba(216, 27, 96, 0.12);
    }

    .card-img {
        width: 100%;
        height: 220px; /* Sedikit lebih tinggi agar foto produk terlihat jelas */
        object-fit: cover;
        border-bottom: 2px solid #fce4ec;
    }

    .card-content {
        padding: 25px 20px;
    }

    .card-feature h3 {
        font-size: 22px;
        font-weight: 700;
        color: #ad1457;
        margin-bottom: 10px;
    }

    @media (max-width: 768px) {
        .about-grid { grid-template-columns: 1fr; }
        .slider-title { font-size: 36px; }
    }
</style>

<div class="about-section">
    
    <div class="swiper hero-slider">
        <div class="swiper-wrapper">
            <div class="swiper-slide">
                <img src="https://images.unsplash.com/photo-1517433670267-08bbd4be890f?q=80&w=1600" alt="Kitchen">
                <div class="slider-overlay">
                    <h1 class="slider-title">Manis Rasa</h1>
                    <p>Dibuat dengan bahan organik & penuh cinta</p>
                </div>
            </div>
            <div class="swiper-slide">
                <img src="https://images.unsplash.com/photo-1488477181946-6428a0291777?q=80&w=1600" alt="Cake">
                <div class="slider-overlay">
                    <h1 class="slider-title">Kualitas Premium</h1>
                    <p>Rasa mewah dalam setiap gigitan</p>
                </div>
            </div>
        </div>
        <div class="swiper-pagination"></div>
    </div>

    <div class="about-container">
        <div class="about-header">
            <h2 class="about-title-main">Produk Unggulan Kami</h2>
            <p style="font-size: 18px; color: #636e72; max-width: 800px; margin: 0 auto;">
                Setiap produk dibuat dengan teliti menggunakan file resep asli dan bahan-bahan segar setiap harinya.
            </p>
        </div>

        <div class="about-grid">
            <div class="card-feature">
                <img src="{{ asset('images/banana puding.jpg') }}" class="card-img" alt="Banana Puding">
                <div class="card-content">
                    <h3>Banana Puding</h3>
                    <p>Perpaduan lembut pisang pilihan dengan krim homemade yang manisnya pas.</p>
                </div>
            </div>

            <div class="card-feature">
                <img src="{{ asset('images/1777267058.jpg') }}" class="card-img" alt="Cakes Kukus">
                <div class="card-content">
                    <h3>Cakes Kukus</h3>
                    <p>Tekstur super lembut dan moist yang meleh di mulut dalam setiap gigitan.</p>
                </div>
            </div>

            <div class="card-feature">
                <img src="{{ asset('images/1777267365.jpg') }}" class="card-img" alt="Lapis Legit">
                <div class="card-content">
                    <h3>Lapis Legit</h3>
                    <p>Resep klasik dengan lapisan sempurna yang menghadirkan rasa premium.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
    const swiper = new Swiper('.hero-slider', {
        loop: true,
        autoplay: { delay: 4000, disableOnInteraction: false },
        pagination: { el: '.swiper-pagination', clickable: true },
        effect: 'fade',
        fadeEffect: { crossFade: true },
    });
</script>

@endsection