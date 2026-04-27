<header class="bg-white shadow-sm border-b-2 border-pink-300">
    <div class="max-w-7xl mx-auto flex items-center justify-between px-6 py-4">

        <!-- LEFT: LOGO + TEXT -->
        <div class="flex items-center gap-4 h-14">
            <img 
                src="{{ asset('images/Ellipse-2.png') }}" 
                alt="Logo"
                class="w-14 h-14 rounded-full object-cover"
            >
            <h1 class="text-xl font-bold text-black">manis rasa</h1>
        </div>

        <!-- MENU -->
        <nav class="hidden md:flex items-center gap-8 font-semibold">

            <a href="/" 
               class="{{ request()->is('/') ? 'text-pink-400' : 'text-black hover:text-pink-400' }}">
                HOME
            </a>

            <a href="/menu" 
               class="{{ request()->is('menu') ? 'text-pink-400' : 'text-black hover:text-pink-400' }}">
                MENU
            </a>

            <a href="/about" 
               class="{{ request()->is('about') ? 'text-pink-400' : 'text-black hover:text-pink-400' }}">
                ABOUT
            </a>

            <a href="/contact" 
               class="{{ request()->is('contact') ? 'text-pink-400' : 'text-black hover:text-pink-400' }}">
                KONTAK
            </a>

            <a href="/cek-order" 
   class="{{ request()->is('cek-order') ? 'text-pink-400' : 'text-black hover:text-pink-400' }}">
    CEK PESANAN
</a>

        </nav>

        <!-- RIGHT BUTTONS -->
        <div class="flex items-center gap-3">

            <!-- ORDER BUTTON -->
            <a href="/order" 
               class="bg-pink-400 hover:bg-pink-500 text-white px-5 py-2 rounded-full flex items-center gap-2 font-semibold">
                📞 Order Now
            </a>

            

            <!-- LOGIN ADMIN ICON -->
           <a href="{{ url('/admin/login') }}"
   class="w-10 h-10 flex items-center justify-center rounded-full border border-gray-300 hover:bg-gray-100"
   title="Login Admin">

    <!-- icon user -->
    <svg xmlns="http://www.w3.org/2000/svg"
         fill="none" viewBox="0 0 24 24"
         stroke-width="1.5" stroke="currentColor"
         class="w-5 h-5 text-black">

        <path stroke-linecap="round" stroke-linejoin="round"
              d="M15.75 6.75a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.5 20.25a8.25 8.25 0 0115 0" />
    </svg>

</a>

        </div>

    </div>
</header>