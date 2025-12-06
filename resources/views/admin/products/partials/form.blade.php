@php
    $isEdit = isset($product);
    $existingImages = $isEdit ? ($product->images ?? collect()) : collect();
@endphp

<div class="grid md:grid-cols-2 gap-6">
    <div class="space-y-4">
        <div>
            <label class="text-sm text-gray-300">Nama Produk</label>
            <input type="text" name="name" value="{{ old('name', $product->name ?? '') }}" required
                class="mt-2 w-full bg-black/60 border border-white/10 rounded-xl px-4 py-3 focus:outline-none focus:border-red-400">
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="text-sm text-gray-300">Ukuran</label>
                <input type="text" name="size" value="{{ old('size', $product->size ?? '') }}" required
                    class="mt-2 w-full bg-black/60 border border-white/10 rounded-xl px-4 py-3 focus:outline-none focus:border-red-400">
            </div>
            <div>
                <label class="text-sm text-gray-300">Harga</label>
                <input type="number" step="0.01" name="price" value="{{ old('price', $product->price ?? '') }}" required
                    class="mt-2 w-full bg-black/60 border border-white/10 rounded-xl px-4 py-3 focus:outline-none focus:border-red-400">
            </div>
        </div>
        <div>
            <label class="text-sm text-gray-300">Kategori</label>
            <select name="category" required class="mt-2 w-full bg-black/60 border border-white/10 rounded-xl px-4 py-3 focus:outline-none focus:border-red-400">
                @foreach($categories as $cat)
                    <option value="{{ $cat }}" @selected(old('category', $product->category ?? '') === $cat)>{{ $cat }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="text-sm text-gray-300">Deskripsi</label>
            <textarea name="description" rows="4"
                class="mt-2 w-full bg-black/60 border border-white/10 rounded-xl px-4 py-3 focus:outline-none focus:border-red-400">{{ old('description', $product->description ?? '') }}</textarea>
        </div>
        <div>
            <label class="text-sm text-gray-300">Benefit (satu per baris)</label>
            <textarea name="benefits" rows="6"
                class="mt-2 w-full bg-black/60 border border-white/10 rounded-xl px-4 py-3 focus:outline-none focus:border-red-400">{{ old('benefits', isset($product) ? implode("\n", $product->benefits ?? []) : '') }}</textarea>
        </div>
    </div>

    <div class="space-y-4" x-data="imageManager(@js(old('image_urls', [])))">
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="text-sm text-gray-300">Link Shopee</label>
                <input type="url" name="shopee_link" value="{{ old('shopee_link', $product->shopee_link ?? '') }}"
                    class="mt-2 w-full bg-black/60 border border-white/10 rounded-xl px-4 py-3 focus:outline-none focus:border-red-400">
            </div>
            <div>
                <label class="text-sm text-gray-300">Link Tokopedia</label>
                <input type="url" name="tokopedia_link" value="{{ old('tokopedia_link', $product->tokopedia_link ?? '') }}"
                    class="mt-2 w-full bg-black/60 border border-white/10 rounded-xl px-4 py-3 focus:outline-none focus:border-red-400">
            </div>
        </div>
        <div>
            <label class="text-sm text-gray-300">Nomor WhatsApp (62...)</label>
            <input type="text" name="whatsapp_number" value="{{ old('whatsapp_number', $product->whatsapp_number ?? '') }}"
                class="mt-2 w-full bg-black/60 border border-white/10 rounded-xl px-4 py-3 focus:outline-none focus:border-red-400">
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="text-sm text-gray-300">Sort Order</label>
                <input type="number" name="sort_order" value="{{ old('sort_order', $product->sort_order ?? 0) }}"
                    class="mt-2 w-full bg-black/60 border border-white/10 rounded-xl px-4 py-3 focus:outline-none focus:border-red-400">
            </div>
            <div class="flex items-center gap-3 mt-6">
                <label class="flex items-center gap-2 text-sm text-gray-200">
                    <input type="checkbox" name="is_hot" value="1" @checked(old('is_hot', $product->is_hot ?? false)) class="accent-red-500">
                    <span>Jadikan HOT</span>
                </label>
                <label class="flex items-center gap-2 text-sm text-gray-200">
                    <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $product->is_active ?? true)) class="accent-emerald-500">
                    <span>Aktif</span>
                </label>
            </div>
        </div>

        <div class="space-y-2">
            <label class="text-sm text-gray-300">Upload Gambar (bisa lebih dari satu)</label>
            <input type="file" name="image_files[]" accept="image/*" multiple class="w-full text-sm text-gray-200 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-red-500 file:text-white file:cursor-pointer">
            <p class="text-xs text-gray-400">Urutan gambar mengikuti urutan upload/URL. Gunakan gambar pertama untuk thumbnail utama.</p>
        </div>

        <div class="space-y-2">
            <div class="flex items-center justify-between">
                <label class="text-sm text-gray-300">URL Gambar (opsional)</label>
                <button type="button" @click="addUrl" class="text-xs text-red-400 hover:text-red-300">+ Tambah URL</button>
            </div>
            <template x-for="(url, index) in urls" :key="index">
                <div class="flex items-center gap-2 mt-2">
                    <input type="url" name="image_urls[]" x-model="urls[index]" placeholder="https://..."
                        class="w-full bg-black/60 border border-white/10 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-red-400">
                    <button type="button" @click="removeUrl(index)" class="text-red-300 hover:text-red-200 text-xs px-2 py-1 border border-white/10 rounded-lg">Hapus</button>
                </div>
            </template>
            <template x-if="!urls.length">
                <p class="text-xs text-gray-400">Klik "Tambah URL" untuk menambahkan link gambar eksternal.</p>
            </template>
        </div>

        @if($isEdit && $existingImages->count())
            <div class="space-y-2">
                <p class="text-sm text-gray-300">Gambar Saat Ini</p>
                <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
                    @foreach($existingImages as $image)
                        <label class="relative block">
                            <input type="checkbox" name="delete_images[]" value="{{ $image->id }}" class="absolute top-2 left-2 accent-red-500">
                            <img src="{{ $image->url }}" alt="{{ $product->name }}" class="w-full h-32 object-cover rounded-xl border border-white/10">
                            <span class="absolute bottom-2 right-2 text-xs bg-black/60 px-2 py-1 rounded-full border border-white/10">Urutan {{ $image->sort_order + 1 }}</span>
                        </label>
                    @endforeach
                </div>
                <p class="text-xs text-gray-400">Centang untuk menghapus gambar. Gambar baru akan ditambahkan di akhir urutan.</p>
            </div>
        @endif
    </div>
</div>

@pushOnce('scripts')
<script>
    function imageManager(initialUrls = []) {
        return {
            urls: initialUrls.length ? initialUrls : [''],
            addUrl() {
                this.urls.push('');
            },
            removeUrl(index) {
                this.urls.splice(index, 1);
            }
        }
    }
</script>
@endPushOnce
