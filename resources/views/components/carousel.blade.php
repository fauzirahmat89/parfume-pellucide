@props(['products'])

<div class="relative" x-data="carousel()">
    <div class="overflow-hidden">
        <div class="flex transition-transform duration-500 ease-out"
             :style="{ transform: `translateX(-${currentSlide * 100}%)` }">
            @foreach($products->chunk(3) as $chunk)
                <div class="w-full flex-shrink-0 grid grid-cols-1 md:grid-cols-3 gap-6 px-2 sm:px-4">
                    @foreach($chunk as $product)
                        @include('components.product-card', ['product' => $product])
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>

    <button @click="prev()" class="absolute left-0 top-1/2 -translate-y-1/2 bg-black/70 border border-white/15 text-white p-3 rounded-full hover:bg-red-600 transition">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
        </svg>
    </button>
    <button @click="next()" class="absolute right-0 top-1/2 -translate-y-1/2 bg-black/70 border border-white/15 text-white p-3 rounded-full hover:bg-red-600 transition">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
        </svg>
    </button>

    <div class="flex justify-center mt-6 space-x-2">
        @foreach($products->chunk(3) as $index => $chunk)
            <button @click="goTo({{ $index }})"
                    :class="currentSlide === {{ $index }} ? 'bg-red-500' : 'bg-gray-500/60'"
                    class="w-3 h-3 rounded-full transition"></button>
        @endforeach
    </div>
</div>

@pushOnce('scripts')
<script>
function carousel() {
    return {
        currentSlide: 0,
        totalSlides: {{ $products->chunk(3)->count() }},
        next() {
            if (this.totalSlides === 0) return;
            this.currentSlide = (this.currentSlide + 1) % this.totalSlides;
        },
        prev() {
            if (this.totalSlides === 0) return;
            this.currentSlide = (this.currentSlide - 1 + this.totalSlides) % this.totalSlides;
        },
        goTo(index) {
            if (this.totalSlides === 0) return;
            this.currentSlide = index;
        },
        init() {
            if (this.totalSlides > 0) {
                setInterval(() => this.next(), 6000);
            }
        }
    }
}
</script>
@endPushOnce
