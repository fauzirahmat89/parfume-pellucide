@props(['product'])

@php
    $benefits = collect($product->benefits ?? [])->take(2);
    $description = \Illuminate\Support\Str::limit($product->description ?? '', 80);
@endphp

<div class="product-card group cursor-pointer" x-data="productGallery(@js($product->gallery_image_urls), '{{ route('products.show', $product->slug) }}')" @click="openDetail($event)">
    <div class="card-glow"></div>

    @if($product->is_hot)
        <span class="hot-badge">HOT PICK</span>
    @endif

    <div class="image-wrapper">
        <img :src="currentImage" alt="{{ $product->name }}" class="w-full h-full object-cover">
        <div class="image-gradient"></div>
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
        <div class="image-dots">
            <template x-for="(img, index) in images" :key="index">
                <span @click.stop="goTo(index)"
                      :class="current === index ? 'opacity-100 bg-white' : 'opacity-60 bg-white/60'"
                      class="no-detail dot"></span>
            </template>
        </div>
    </div>

    <div class="card-body">
        <div class="flex items-start justify-between gap-3">
            <div class="space-y-2">
                <div class="flex flex-wrap gap-2 text-[11px] uppercase tracking-[0.18em] text-gray-300">
                    <span class="meta-chip">{{ $product->category }}</span>
                    <span class="meta-chip subtle">{{ $product->size }}</span>
                </div>
                <h3 class="text-lg font-semibold leading-snug">{{ $product->name }}</h3>
                <p class="text-xs text-gray-300">{{ $description }}</p>
            </div>
            <div class="price-chip">
                <span class="text-[11px] uppercase text-gray-300">Harga</span>
                <div class="text-base font-semibold text-white">{{ $product->formatted_price }}</div>
            </div>
        </div>

        @if($benefits->isNotEmpty())
            <div class="mt-3 space-y-2">
                @foreach($benefits as $benefit)
                    <div class="benefit-line">
                        <span class="benefit-dot"></span>
                        <span class="text-xs text-gray-200">{{ $benefit }}</span>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <div class="buy-buttons">
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
    function productGallery(images = [], detailUrl = '') {
        return {
            detailUrl: detailUrl,
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
