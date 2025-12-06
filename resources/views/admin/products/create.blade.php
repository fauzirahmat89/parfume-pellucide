@extends('layouts.admin')

@section('title', 'Tambah Produk')

@section('content')
    <div class="max-w-4xl">
        <h1 class="text-2xl font-semibold mb-4">Tambah Produk</h1>
        <p class="text-sm text-gray-300 mb-6">Masukkan detail produk. Benefit dipisah per baris. Maksimal 4 produk HOT ditampilkan di beranda.</p>

        @if ($errors->any())
            <div class="mb-4 bg-red-500/10 border border-red-500/40 text-red-200 px-4 py-3 rounded-lg">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @include('admin.products.partials.form', ['product' => null])
            <div class="flex gap-3">
                <button class="cta-btn cta-primary">Simpan</button>
                <a href="{{ route('admin.products.index') }}" class="cta-btn cta-ghost">Batal</a>
            </div>
        </form>
    </div>
@endsection
