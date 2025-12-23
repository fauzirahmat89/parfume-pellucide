<!DOCTYPE html>
<html lang="id">
<head>
    @php
        $defaultDescription = 'Pellucide - Skincare premium terinspirasi Korea untuk kulit tropis Indonesia. Hot products, katalog lengkap, dan pembelian via Shopee, Tokopedia, atau WhatsApp.';
        $metaTitle = trim($__env->yieldContent('meta_title') ?: $__env->yieldContent('title') ?: config('app.name', 'Pellucide'));
        $metaDescription = trim($__env->yieldContent('meta_description') ?: $defaultDescription);
        $metaImage = trim($__env->yieldContent('meta_image') ?: asset('images/placeholder-product.svg'));
        $canonical = trim($__env->yieldContent('canonical') ?: url()->current());
        $metaRobots = trim($__env->yieldContent('meta_robots') ?: (app()->environment('production') ? 'index,follow' : 'noindex,nofollow'));
    @endphp
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{ $metaDescription }}">
    <meta name="robots" content="{{ $metaRobots }}">
    <link rel="canonical" href="{{ $canonical }}">
    <title>{{ $metaTitle }}</title>

    <!-- Open Graph -->
    <meta property="og:type" content="website">
    <meta property="og:title" content="{{ $metaTitle }}">
    <meta property="og:description" content="{{ $metaDescription }}">
    <meta property="og:url" content="{{ $canonical }}">
    <meta property="og:image" content="{{ $metaImage }}">
    <meta property="og:locale" content="id_ID">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $metaTitle }}">
    <meta name="twitter:description" content="{{ $metaDescription }}">
    <meta name="twitter:image" content="{{ $metaImage }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&family=Playfair+Display:wght@400;500;600;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @stack('styles')

    <script type="application/ld+json">
        {!! json_encode([
            '@context' => 'https://schema.org',
            '@type' => 'Organization',
            'name' => 'Pellucide',
            'url' => url('/'),
            'logo' => asset('images/placeholder-product.svg'),
            'contactPoint' => [
                '@type' => 'ContactPoint',
                'contactType' => 'customer service',
                'email' => 'info@pellucide.com',
            ],
        ], JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) !!}
    </script>
    @stack('structured_data')
</head>
<body class="bg-[#0f0f0f] text-white">
    @include('components.navbar')

    <main class="pt-24">
        @yield('content')
    </main>

    @include('components.chat-widget')
    @include('components.footer')

    @stack('scripts')
</body>
</html>
