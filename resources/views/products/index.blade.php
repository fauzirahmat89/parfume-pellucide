@extends('layouts.app')

@section('title', 'Produk Pellucide')
@section('meta_title', 'Katalog Produk Pellucide')
@section('meta_description', 'Katalog lengkap skincare Pellucide: cream, serum, cleanser, toner untuk kulit tropis. Beli via Shopee, Tokopedia, atau WhatsApp.')
@section('canonical', route('products.index'))

@section('content')
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6 mb-8">
            <div>
                <h1 class="section-heading">Semua Produk</h1>
                <p class="section-subtitle mt-2">Eksplorasi lengkap produk Pellucide.</p>
            </div>
            <form method="GET" action="{{ route('products.index') }}" class="flex items-center gap-3">
                <select name="category" class="bg-black/60 border border-white/15 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-red-400">
                    <option value="">Semua Kategori</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat }}" @selected($category === $cat)>{{ $cat }}</option>
                    @endforeach
                </select>
                <button class="cta-btn cta-ghost">Filter</button>
            </form>
        </div>

        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @forelse($products as $product)
                @include('components.product-card', ['product' => $product])
            @empty
                <p class="text-gray-300">Produk tidak ditemukan.</p>
            @endforelse
        </div>

        <div class="mt-10">
            {{ $products->withQueryString()->links() }}
        </div>
    </section>
@endsection
