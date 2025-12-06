@extends('layouts.admin')

@section('title', 'Kelola Produk')

@section('content')
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-semibold">Produk</h1>
            <p class="text-gray-300 text-sm">CRUD produk, toggle HOT dan status aktif.</p>
        </div>
        <a href="{{ route('admin.products.create') }}" class="cta-btn cta-primary">Tambah Produk</a>
    </div>

    @if(session('success'))
        <div class="mb-4 bg-green-500/10 border border-green-500/40 text-green-200 px-4 py-3 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto glass-panel rounded-2xl">
        <table class="min-w-full text-left">
            <thead class="text-sm text-gray-300 border-b border-white/10">
                <tr>
                    <th class="px-4 py-3">Produk</th>
                    <th class="px-4 py-3">Harga</th>
                    <th class="px-4 py-3">Kategori</th>
                    <th class="px-4 py-3">HOT</th>
                    <th class="px-4 py-3">Aktif</th>
                    <th class="px-4 py-3 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-white/10">
            @foreach($products as $product)
                <tr>
                    <td class="px-4 py-3">
                        <div class="font-semibold">{{ $product->name }}</div>
                        <div class="text-sm text-gray-400">{{ $product->size }}</div>
                    </td>
                    <td class="px-4 py-3 text-red-400">{{ $product->formatted_price }}</td>
                    <td class="px-4 py-3 text-gray-200">{{ $product->category }}</td>
                    <td class="px-4 py-3">
                        <button class="toggle-hot px-3 py-1 rounded-full text-xs font-semibold {{ $product->is_hot ? 'bg-red-500 text-white' : 'bg-white/10 text-gray-200' }}"
                                data-url="{{ route('admin.products.toggle-hot', $product) }}">
                            {{ $product->is_hot ? 'HOT' : 'Tidak' }}
                        </button>
                    </td>
                    <td class="px-4 py-3">
                        <button class="toggle-active px-3 py-1 rounded-full text-xs font-semibold {{ $product->is_active ? 'bg-emerald-500 text-white' : 'bg-white/10 text-gray-200' }}"
                                data-url="{{ route('admin.products.toggle-active', $product) }}">
                            {{ $product->is_active ? 'Aktif' : 'Nonaktif' }}
                        </button>
                    </td>
                    <td class="px-4 py-3 text-right space-x-2">
                        <a href="{{ route('admin.products.edit', $product) }}" class="text-sm text-blue-300 hover:text-blue-200">Edit</a>
                        <form method="POST" action="{{ route('admin.products.destroy', $product) }}" class="inline">
                            @csrf
                            @method('DELETE')
                            <button class="text-sm text-red-300 hover:text-red-200" onclick="return confirm('Hapus produk ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $products->links() }}
    </div>
@endsection

@push('scripts')
<script>
    const csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    function toggleAction(button, url) {
        button.disabled = true;
        fetch(url, {
            method: 'PATCH',
            headers: {
                'X-CSRF-TOKEN': csrf,
                'Accept': 'application/json'
            }
        })
        .then(res => res.json())
        .then(() => window.location.reload())
        .catch(() => alert('Gagal memperbarui status'))
        .finally(() => button.disabled = false);
    }

    document.querySelectorAll('.toggle-hot').forEach(btn => {
        btn.addEventListener('click', () => toggleAction(btn, btn.dataset.url));
    });

    document.querySelectorAll('.toggle-active').forEach(btn => {
        btn.addEventListener('click', () => toggleAction(btn, btn.dataset.url));
    });
</script>
@endpush
