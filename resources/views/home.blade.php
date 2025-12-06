@extends('layouts.app')

@section('title', 'Pellucide - Skincare Premium untuk Iklim Tropis')

@section('content')
    <div class="page-spray">
    <section class="hero-bg relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 lg:py-24 grid lg:grid-cols-2 gap-12 items-center">
            <div class="space-y-6">
                <p class="pill w-max text-white/80">Premium Tropical Skincare</p>
                <h1 class="text-4xl lg:text-5xl font-semibold leading-tight">
                    Pellucide
                    <span class="block brand-script text-3xl text-red-400 mt-2">Han Su</span>
                </h1>
                <p class="text-gray-200 text-lg leading-relaxed">
                    Premium Korean-inspired skincare formulated khusus untuk iklim tropis Indonesia. Kecantikan yang jernih, kulit yang bercahaya.
                </p>
                <div class="flex flex-wrap gap-3">
                    <a href="#products" class="cta-btn cta-primary">Lihat Produk</a>
                    <a href="#hot-products" class="cta-btn cta-ghost">Best Sellers</a>
                </div>
                <div class="flex gap-4 text-sm text-gray-300">
                    <span class="pill border-red-500 text-red-400">BPOM</span>
                    <span class="pill">Dermatologically Tested</span>
                    <span class="pill">Unisex</span>
                </div>
            </div>
            <div class="relative">
                <div class="absolute -left-6 -top-6 w-72 h-72 bg-red-500/20 blur-3xl"></div>
                <div class="absolute -right-10 bottom-0 w-80 h-80 bg-white/10 blur-3xl"></div>
                <div class="glass-panel rounded-3xl p-6 border-white/10 shadow-2xl">
                    <img src="{{ $hotProducts->first()?->primary_image_url ?? asset('images/placeholder-product.svg') }}" alt="Pellucide Hero" class="w-full rounded-2xl shadow-xl">
                    <div class="mt-6">
                        <p class="text-sm uppercase tracking-[0.2em] text-gray-300">Best Seller</p>
                        <h3 class="text-2xl font-semibold">{{ $hotProducts->first()?->name ?? 'Pellucide Series' }}</h3>
                        <p class="text-gray-300 mt-2">Formula premium yang menjaga kulit tetap lembap, cerah, dan kuat di iklim tropis.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="hot-products" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="flex items-center justify-between mb-8">
            <div>
                <h2 class="section-heading">Hot Products</h2>
                <p class="section-subtitle mt-2">Dipilih langsung oleh admin, maksimal 4 produk unggulan.</p>
            </div>
            <a href="#products" class="text-sm text-red-400 hover:text-red-300">Lihat semua</a>
        </div>
        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-4">
            @forelse($hotProducts as $product)
                @include('components.product-card', ['product' => $product])
            @empty
                <p class="text-gray-300">Belum ada produk yang ditandai sebagai HOT.</p>
            @endforelse
        </div>
    </section>

    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="flex items-center justify-between mb-8">
            <div>
                <h2 class="section-heading">Product Carousel</h2>
                <p class="section-subtitle mt-2">Jelajahi semua rangkaian produk Pellucide.</p>
            </div>
        </div>
        @include('components.carousel', ['products' => $products])
    </section>

    <section id="products" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="flex items-center justify-between mb-8">
            <div>
                <h2 class="section-heading">Semua Produk</h2>
                <p class="section-subtitle mt-2">Grid produk lengkap untuk eksplorasi cepat.</p>
            </div>
            <a href="{{ route('products.index') }}" class="cta-btn cta-ghost">View All</a>
        </div>
        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @foreach($products as $product)
                @include('components.product-card', ['product' => $product])
            @endforeach
        </div>
    </section>

    <section id="about" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="glass-panel rounded-3xl p-8 md:p-12 grid md:grid-cols-2 gap-10">
            <div>
                <h2 class="section-heading mb-4">Why Pellucide?</h2>
                <p class="text-gray-300 mb-6">Keunggulan Pellucide untuk kulit tropis Indonesia.</p>
                <div class="grid sm:grid-cols-2 gap-4 text-sm text-gray-200">
                    <div class="glass-panel rounded-2xl p-4">
                        <p class="font-semibold text-white mb-2">Aman & BPOM</p>
                        <p class="text-gray-300">Teruji klinis dan berizin edar.</p>
                    </div>
                    <div class="glass-panel rounded-2xl p-4">
                        <p class="font-semibold text-white mb-2">Tropis-ready</p>
                        <p class="text-gray-300">Diformulasikan untuk kelembapan dan panas tropis.</p>
                    </div>
                    <div class="glass-panel rounded-2xl p-4">
                        <p class="font-semibold text-white mb-2">Unisex</p>
                        <p class="text-gray-300">Nyaman digunakan pria maupun wanita.</p>
                    </div>
                    <div class="glass-panel rounded-2xl p-4">
                        <p class="font-semibold text-white mb-2">Terjangkau</p>
                        <p class="text-gray-300">Kualitas premium dengan harga bersahabat.</p>
                    </div>
                </div>
            </div>
            <div class="glass-panel rounded-3xl p-6 border-white/10">
                <h3 class="text-xl font-semibold mb-4">Kategori Produk</h3>
                <div class="flex flex-wrap gap-3">
                    @foreach($categories as $cat)
                        <span class="pill">{{ $cat }}</span>
                    @endforeach
                </div>
                <div class="mt-8 space-y-3 text-sm text-gray-300">
                    <p>• Link Shopee, Tokopedia, dan WhatsApp pada setiap produk.</p>
                    <p>• Benefit per produk ditulis per baris untuk memudahkan pembacaan.</p>
                    <p>• Status HOT maksimal 4 produk ditampilkan di beranda.</p>
                </div>
            </div>
        </div>
    </section>
    </div>
@endsection
