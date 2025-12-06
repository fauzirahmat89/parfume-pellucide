<nav class="fixed inset-x-0 top-0 z-50 bg-black/70 backdrop-blur-xl border-b border-white/10" x-data="{ open: false }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
        <a href="{{ route('home') }}" class="flex items-baseline gap-2">
            <span class="brand-script text-3xl text-white">Pellucide</span>
            <span class="text-sm text-red-400 tracking-wide">Han Su</span>
        </a>
        <div class="hidden md:flex items-center gap-8 text-sm font-semibold">
            <a href="{{ route('home') }}" class="text-white hover:text-red-400 transition">Home</a>
            <a href="{{ route('products.index') }}" class="text-white hover:text-red-400 transition">Products</a>
            <a href="#about" class="text-white hover:text-red-400 transition">About</a>
            <a href="#contact" class="text-white hover:text-red-400 transition">Contact</a>
        </div>
        <button class="md:hidden text-white" @click="open = !open">
            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path x-show="!open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                <path x-show="open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
    </div>
    <div x-show="open" x-transition class="md:hidden bg-black/90 border-t border-white/10">
        <div class="px-4 py-4 space-y-3">
            <a href="{{ route('home') }}" class="block text-white py-2">Home</a>
            <a href="{{ route('products.index') }}" class="block text-white py-2">Products</a>
            <a href="#about" class="block text-white py-2">About</a>
            <a href="#contact" class="block text-white py-2">Contact</a>
        </div>
    </div>
</nav>
