@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('content')
    <div class="space-y-8">
        <div>
            <h1 class="text-3xl font-semibold">Dashboard</h1>
            <p class="text-gray-300 mt-2">Ringkasan cepat performa produk.</p>
        </div>

        <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
            <div class="glass-panel rounded-2xl p-6">
                <p class="text-gray-300 text-sm">Total Produk</p>
                <div class="text-3xl font-semibold mt-2">{{ $totalProducts }}</div>
            </div>
            <div class="glass-panel rounded-2xl p-6">
                <p class="text-gray-300 text-sm">Hot Products</p>
                <div class="text-3xl font-semibold mt-2 text-red-400">{{ $hotProducts }}</div>
            </div>
            <div class="glass-panel rounded-2xl p-6">
                <p class="text-gray-300 text-sm">Produk Aktif</p>
                <div class="text-3xl font-semibold mt-2">{{ $activeProducts }}</div>
            </div>
        </div>

        <div class="glass-panel rounded-2xl p-6 flex items-center justify-between">
            <div>
                <h3 class="text-xl font-semibold">Kelola Produk</h3>
                <p class="text-gray-300 text-sm mt-1">Tambah, edit, atau tandai produk HOT.</p>
            </div>
            <a href="{{ route('admin.products.create') }}" class="cta-btn cta-primary">Tambah Produk</a>
        </div>
    </div>
@endsection
