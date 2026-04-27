<!DOCTYPE html>
<html>
<head>
    <title>Manis Rasa</title>

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- 🔥 TAMBAHKAN INI (ICON) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

</head>
<body>

    @include('layouts.header')

    <div class="p-6">
        @yield('content')
    </div>

    <!-- FOOTER -->
    @include('layouts.footer')

</body>
</html>