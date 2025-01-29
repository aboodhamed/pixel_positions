<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pixil Positions2</title>

    @vite(['resources/css/app.css','resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hanken+Grotesk:wght@400;500;600&display=swap" rel="stylesheet">
</head>

<body class="bg-black text-white font-hanken-grotesk flex flex-col min-h-screen">         
    <div class="px-4 sm:px-10 flex-grow">
        <!-- Navigation Bar -->
        <nav class="flex justify-between items-center py-4 border-b border-white/10">
            <!-- Logo -->
            <div>
                <a href="/">
                    <img src="{{ Vite::asset('resources/images/logo.svg') }}" alt="Logo">
                </a>
            </div>

            <!-- Desktop Navigation Links -->
            <div class="hidden md:flex space-x-6 font-bold">
                <a href="/">Jobs</a>
                <a href="/">Careers</a>
                <a href="/">Salaries</a>
                <a href="/">Companies</a>
            </div>

            <!-- Auth Links (Desktop) -->
            @auth
            <div class="hidden md:flex space-x-6 font-bold">
                <a href="/jobs">Post a Job</a>
                <form method="POST" action="/logout">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Log Out</button>
                </form>
            </div>   
            @endauth

            @guest
            <div class="hidden md:flex space-x-6 font-bold">
                <a href="/register">Sign Up</a>
                <a href="/login">Log In</a>
            </div>
            @endguest

            <!-- Mobile Menu Button -->
            <button id="mobile-menu-button" class="md:hidden focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                </svg>
            </button>
        </nav>

        <!-- Mobile Navigation Links (Hidden by Default) -->
        <div id="mobile-menu" class="md:hidden hidden mt-4 space-y-4">
            <a href="/" class="block">Jobs</a>
            <a href="/" class="block">Careers</a>
            <a href="/" class="block">Salaries</a>
            <a href="/" class="block">Companies</a>

            @auth
            <a href="/jobs" class="block">Post a Job</a>
            <form method="POST" action="/logout" class="block">
                @csrf
                @method('DELETE')
                <button type="submit">Log Out</button>
            </form>
            @endauth

            @guest
            <a href="/register" class="block">Sign Up</a>
            <a href="/login" class="block">Log In</a>
            @endguest
        </div>

        <!-- Main Content -->
        <main class="mt-10 max-w-[986px] mx-auto">
            {{ $slot }}
        </main>
    </div>

    <!-- Footer -->
    <footer class="border-t border-white/10 text-gray-300 py-6 mt-10">
        <div class="text-center">
            <p class="text-sm">&copy; 2025 Abdalrman Hamed. All rights reserved.</p>
            <p class="text-sm mt-2">Follow us on <a href="https://www.instagram.com/abood3omar/" target="_blank" class="text-pink-400 hover:text-blue-300">Instagram</a> and <a href="https://linkedin.com/in/abdalrhman-hamed-5b929725b" target="_blank" class="text-blue-400 hover:text-blue-300">LinkedIn</a></p>
        </div>
    </footer>

    <!-- JavaScript for Mobile Menu Toggle -->
    <script>
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');

        mobileMenuButton.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });
    </script>
</body>
</html>