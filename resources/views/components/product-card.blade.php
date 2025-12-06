@props(['product'])

<div class="product-card group cursor-pointer" x-data="productGallery(@js($product->gallery_image_urls))" @click="openDetail($event)">
    @if($product->is_hot)
        <span class="hot-badge">HOT</span>
    @endif

    <div class="image-wrapper">
        <img :src="currentImage" alt="{{ $product->name }}" class="w-full h-full object-cover">
        <template x-if="images.length > 1">
            <div class="absolute inset-0 flex items-center justify-between px-3 opacity-0 group-hover:opacity-100 transition">
                <button type="button" @click.stop="prev" class="no-detail bg-black/60 text-white p-2 rounded-full border border-white/15 hover:bg-red-500/80">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                </button>
                <button type="button" @click.stop="next" class="no-detail bg-black/60 text-white p-2 rounded-full border border-white/15 hover:bg-red-500/80">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </button>
            </div>
        </template>
        <div class="absolute top-3 left-1/2 -translate-x-1/2 flex gap-1 bg-black/60 px-3 py-2 rounded-full">
            <template x-for="(img, index) in images" :key="index">
                <span @click.stop="goTo(index)"
                      :class="current === index ? 'bg-red-500' : 'bg-white/50'"
                      class="no-detail w-2.5 h-2.5 rounded-full cursor-pointer transition"></span>
            </template>
        </div>
    </div>

    <div class="p-4 flex-1 flex flex-col gap-2">
        <div class="text-xs uppercase tracking-[0.2em] text-gray-300">{{ $product->category }}</div>
        <h3 class="text-xl font-semibold">{{ $product->name }}</h3>
        <div class="text-sm text-gray-300">{{ $product->size }}</div>
        <div class="text-lg font-semibold text-red-400">{{ $product->formatted_price }}</div>
    </div>

    <div class="buy-buttons px-4 pb-4 flex gap-2">
        @if($product->shopee_link)
            <a href="{{ $product->shopee_link }}" target="_blank" rel="noreferrer" class="no-detail btn-shopee">Shopee</a>
        @endif
        @if($product->tokopedia_link)
            <a href="{{ $product->tokopedia_link }}" target="_blank" rel="noreferrer" class="no-detail btn-tokped">Tokopedia</a>
        @endif
        @if($product->whatsapp_link)
            <a href="{{ $product->whatsapp_link }}" target="_blank" rel="noreferrer" class="no-detail btn-wa">WhatsApp</a>
        @endif
    </div>
</div>

@pushOnce('scripts')
<script>
    function productGallery(images = []) {
        return {
            detailUrl: "{{ route('products.show', $product->slug) }}",
            images: images.length ? images : ["{{ asset('images/placeholder-product.svg') }}"],
            current: 0,
            get currentImage() {
                return this.images[this.current] ?? this.images[0];
            },
            next() {
                if (this.images.length < 2) return;
                this.current = (this.current + 1) % this.images.length;
            },
            prev() {
                if (this.images.length < 2) return;
                this.current = (this.current - 1 + this.images.length) % this.images.length;
            },
            goTo(index) {
                if (this.images.length < 2) return;
                this.current = index;
            },
            openDetail(event) {
                if (event.target.closest('.no-detail')) {
                    return;
                }

                window.location = this.detailUrl;
            }
        }
    }
</script>
@endPushOnce
