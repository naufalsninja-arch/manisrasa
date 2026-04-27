@extends('layouts.app')

@section('content')

<style>
    .contact-container {
        max-width: 900px;
        margin: 0 auto;
        padding: 50px 20px;
        text-align: center;
    }

    .contact-title {
        font-size: 36px;
        font-weight: bold;
        margin-bottom: 20px;
    }

    .contact-text {
        font-size: 18px;
        color: #555;
        margin-bottom: 40px;
    }

    .contact-box {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
    }

    .box {
        background: #fff;
        padding: 20px;
        border-radius: 12px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }

    .box h3 {
        color: #e91e63;
        margin-bottom: 10px;
    }

    .form-contact {
        margin-top: 40px;
        text-align: left;
    }

    .form-contact input,
    .form-contact textarea {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ddd;
        border-radius: 8px;
    }

    .btn-submit {
        background: #e91e63;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 8px;
        cursor: pointer;
    }

    @media (max-width: 768px) {
        .contact-box {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="contact-container">

    <h1 class="contact-title">Hubungi Kami</h1>

    <p class="contact-text">
        Kami siap membantu kamu kapan saja. Silakan hubungi kami melalui informasi di bawah atau kirim pesan langsung.
    </p>

    <!-- CONTACT INFO -->
    <div class="contact-box">

        <div class="box">
            <h3>📍 Alamat</h3>
            <p>Jalan Sumatra No 68</p>
        </div>

        <div class="box">
            <h3>📞 Telepon</h3>
            <p>+62 812 3456 7890</p>
        </div>

        <div class="box">
            <h3>📷 Instagram</h3>
            <p>@manisrasaofficial</p>
        </div>

    </div>

    <!-- FORM -->
    <div class="form-contact">
        <h2>Kirim Pesan</h2>

        <form>
            <input type="text" placeholder="Nama">
            <input type="email" placeholder="Email">
            <textarea rows="5" placeholder="Pesan"></textarea>
            <button class="btn-submit" type="submit">Kirim</button>
        </form>
    </div>

</div>

@endsection