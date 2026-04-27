@extends('layouts.app')

@section('content')

<link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;600;700&family=Playfair+Display:ital,wght@0,700;1,700&display=swap" rel="stylesheet">

<style>
    .about-page {
        font-family: 'Quicksand', sans-serif;
        background-color: #fff;
        color: #333;
        overflow-x: hidden;
    }

    /* HEADER KHUSUS ABOUT */
    .about-intro {
        padding: 100px 20px;
        text-align: center;
        background: #fffafb;
    }

    .about-intro h1 {
        font-family: 'Playfair Display', serif;
        font-size: 50px;
        color: #d81b60;
        margin-bottom: 20px;
    }

    .about-intro p {
        font-size: 20px;
        color: #777;
        max-width: 700px;
        margin: 0 auto;
        line-height: 1.6;
    }

    /* SECTION BERSILANGAN (STORYTELLING) */
    .story-section {
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 80px 10%;
        gap: 60px;
    }

    .story-section:nth-child(even) {
        flex-direction: row-reverse;
        background-color: #fffcfd;
    }

    .story-image {
        flex: 1;
        max-width: 500px;
    }

    .story-image img {
        width: 100%;
        height: 400px;
        object-fit: cover;
        border-radius: 30px;
        box-shadow: 20px 20px 0px #fce4ec; /* Aksen dekoratif kotak di belakang foto */
        transition: transform 0.4s ease;
    }

    .story-section:hover .story-image img {
        transform: scale(1.03);
    }

    .story-content {
        flex: 1;
    }

    .story-content span {
        text-transform: uppercase;
        color: #ff69b4;
        font-weight: 700;
        letter-spacing: 2px;
        font-size: 14px;
    }

    .story-content h2 {
        font-family: 'Playfair Display', serif;
        font-size: 36px;
        color: #2d3436;
        margin: 15px 0;
    }

    .story-content p {
        font-size: 17px;
        line-height: 1.8;
        color: #636e72;
    }

    /* FOOTER BANNER */
    .about-cta {
        background-color: #d81b60;
        color: white;
        padding: 60px 20px;
        text-align: center;
        margin-top: 50px;
    }

    .about-cta h2 {
        font-family: 'Playfair Display', serif;
        font-size: 32px;
        margin-bottom: 20px;
    }

    @media (max-width: 768px) {
        .story-section, .story-section:nth-child(even) {
            flex-direction: column;
            padding: 40px 20px;
            text-align: center;
        }
        .about-intro h1 { font-size: 36px; }
    }
</style>

<div class="about-page">

    <section class="about-intro">
        <h1>Filosofi Rasa</h1>
        <p>Di Manis Rasa, kami percaya bahwa setiap potong kue adalah sebuah cerita, dan setiap rasa adalah kenangan yang abadi.</p>
    </section>

    <section class="story-section">
        <div class="story-image">
            <img src="{{ asset('images/banana puding.jpg') }}" alt="Kisah Banana Puding">
        </div>
        <div class="story-content">
            <span>The Signature</span>
            <h2>Banana Puding</h2>
            <p>Terinspirasi dari resep klasik yang disempurnakan, Banana Puding kami bukan sekadar dessert. Kami memilih pisang dengan tingkat kematangan sempurna untuk menciptakan tekstur krim yang lembut dan aroma yang menggugah selera tanpa pemanis buatan berlebih.</p>
        </div>
    </section>

    <section class="story-section">
        <div class="story-image">
            <img src="{{ asset('images/1777267058.jpg') }}" alt="Proses Cakes Kukus">
        </div>
        <div class="story-content">
            <span>Tradisi & Kualitas</span>
            <h2>Cakes Kukus</h2>
            <p>Kelembutan adalah prioritas kami. Dengan teknik pengukusan yang dijaga suhunya secara konsisten, Cakes Kukus Manis Rasa memiliki kelembapan (moist) yang tinggi. Rahasia kami terletak pada kesabaran dalam setiap menit proses pembuatannya.</p>
        </div>
    </section>

    <section class="story-section">
        <div class="story-image">
            <img src="{{ asset('images/1777267365.jpg') }}" alt="Seni Lapis Legit">
        </div>
        <div class="story-content">
            <span>Seni Melapis</span>
            <h2>Lapis Legit Premium</h2>
            <p>Mahakarya yang membutuhkan ketelitian tinggi. Setiap lapisannya adalah bukti dedikasi kami terhadap kualitas. Menggunakan bahan-bahan premium, kami memastikan aroma rempah dan gurihnya mentega menyatu sempurna dalam setiap gigitan mewah Anda.</p>
        </div>
    </section>

    <section class="about-cta">
        <h2>"Menghadirkan Kebahagiaan di Setiap Meja Makan"</h2>
        <p>Terima kasih telah menjadi bagian dari perjalanan Manis Rasa.</p>
    </section>

</div>

@endsection