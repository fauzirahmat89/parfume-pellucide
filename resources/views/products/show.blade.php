@extends('layouts.app')

@section('title', $product->name . ' - Pellucide')

@section('content')
    <section class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-16 space-y-12">
        <div class="grid lg:grid-cols-2 gap-10 items-start">
            <div class="glass-panel rounded-3xl overflow-hidden" x-data="detailGallery(@js($product->gallery_image_urls))">
                <div class="relative">
                    <img :src="currentImage" alt="{{ $product->name }}" class="w-full h-full object-cover">
                    <template x-if="images.length > 1">
                        <div class="absolute inset-0 flex items-center justify-between px-4">
                            <button type="button" @click="prev" class="bg-black/60 text-white p-3 rounded-full border border-white/15 hover:bg-red-500/80">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                                </svg>
                            </button>
                            <button type="button" @click="next" class="bg-black/60 text-white p-3 rounded-full border border-white/15 hover:bg-red-500/80">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </button>
                        </div>
                    </template>
                    <div class="absolute bottom-3 left-1/2 -translate-x-1/2 flex gap-1">
                        <template x-for="(img, index) in images" :key="index">
                            <span @click="goTo(index)"
                                  :class="current === index ? 'bg-red-500' : 'bg-white/60'"
                                  class="w-3 h-3 rounded-full cursor-pointer transition"></span>
                        </template>
                    </div>
                </div>
                <div class="flex gap-3 p-4 overflow-x-auto">
                    <template x-for="(img, index) in images" :key="'thumb-' + index">
                        <button type="button" @click="goTo(index)" class="relative">
                            <img :src="img" alt="Thumbnail" class="h-20 w-16 object-cover rounded-xl border border-white/10">
                            <span x-show="current === index" class="absolute inset-0 ring-2 ring-red-500 rounded-xl"></span>
                        </button>
                    </template>
                </div>
            </div>
            <div class="space-y-4">
                <p class="pill w-max text-white/80">{{ $product->category }} · {{ $product->size }}</p>
                <h1 class="text-4xl font-semibold">{{ $product->name }}</h1>
                <div class="text-2xl text-red-400 font-semibold">{{ $product->formatted_price }}</div>

                <div class="flex gap-2 flex-wrap">
                    @if($product->shopee_link)
                        <a href="{{ $product->shopee_link }}" target="_blank" rel="noreferrer" class="cta-btn cta-primary">Beli di Shopee</a>
                    @endif
                    @if($product->tokopedia_link)
                        <a href="{{ $product->tokopedia_link }}" target="_blank" rel="noreferrer" class="cta-btn cta-ghost">Beli di Tokopedia</a>
                    @endif
                    @if($product->whatsapp_link)
                        <a href="{{ $product->whatsapp_link }}" target="_blank" rel="noreferrer" class="cta-btn cta-ghost border-green-500 text-green-400">WhatsApp</a>
                    @endif
                </div>

                <div>
                    <h3 class="text-lg font-semibold mb-2">Benefit</h3>
                    <ul class="space-y-2 text-gray-200">
                        @foreach($product->benefits ?? [] as $benefit)
                            <li class="flex items-start gap-2">
                                <span class="text-red-400 mt-[6px]">•</span>
                                <span>{{ $benefit }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        <div class="glass-panel rounded-3xl p-8">
            <h2 class="text-2xl font-semibold mb-3">Deskripsi Produk</h2>
            <p class="text-gray-200 leading-relaxed">{{ $product->description ?? 'Deskripsi akan segera hadir.' }}</p>
        </div>

        <div>
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-semibold">Produk Terkait</h2>
            </div>
            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                @forelse($related as $item)
                    @include('components.product-card', ['product' => $item])
                @empty
                    <p class="text-gray-300">Belum ada produk terkait.</p>
                @endforelse
            </div>
        </div>
    </section>

@pushOnce('scripts')
<script>
    function detailGallery(images = []) {
        return {
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
                if (this.images.length < 2) {
                    this.current = 0;
                    return;
                }

                this.current = index;
            }
        }
    }
</script>
@endPushOnce
@endsection
