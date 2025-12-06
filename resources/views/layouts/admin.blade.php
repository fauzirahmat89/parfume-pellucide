<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Pellucide')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&family=Playfair+Display:wght@400;500;600;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @stack('styles')
</head>
<body class="bg-[#0f0f0f] text-white min-h-screen">
    <div class="flex min-h-screen">
        <aside class="w-72 hidden md:flex flex-col gap-6 p-6 border-r border-white/10 bg-black/60 backdrop-blur-xl">
            <div>
                <div class="text-2xl brand-script text-white">Pellucide</div>
                <div class="text-sm text-red-400 tracking-wide">Admin Panel</div>
            </div>
            <nav class="admin-nav flex flex-col gap-2">
                <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                <a href="{{ route('admin.products.index') }}">Produk</a>
            </nav>
            <form method="POST" action="{{ route('admin.logout') }}" class="mt-auto">
                @csrf
                <button class="w-full px-4 py-2 rounded-lg bg-red-600 hover:bg-red-700 font-semibold">Logout</button>
            </form>
        </aside>

        <div class="flex-1">
            <header class="md:hidden sticky top-0 z-40 bg-black/80 backdrop-blur-xl border-b border-white/10 px-4 py-3 flex items-center justify-between">
                <div>
                    <div class="text-xl brand-script">Pellucide</div>
                    <div class="text-xs text-gray-300">Admin</div>
                </div>
                <div class="flex items-center gap-3">
                    <a href="{{ route('admin.dashboard') }}" class="text-sm text-gray-200">Dashboard</a>
                    <a href="{{ route('admin.products.index') }}" class="text-sm text-gray-200">Produk</a>
                </div>
            </header>

            <main class="p-6">
                @yield('content')
            </main>
        </div>
    </div>

    @stack('scripts')
</body>
</html>
