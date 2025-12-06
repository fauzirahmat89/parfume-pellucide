<footer id="contact" class="mt-20 border-t border-white/10 bg-black/60 backdrop-blur-xl">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 grid gap-10 md:grid-cols-3">
        <div class="space-y-3">
            <div class="brand-script text-3xl">Pellucide</div>
            <p class="text-gray-300 text-sm max-w-sm">
                Premium Korean-inspired skincare crafted for tropical skin. Kecantikan yang jernih, kulit yang bercahaya.
            </p>
        </div>
        <div>
            <h4 class="text-lg font-semibold mb-3">Kontak</h4>
            <ul class="space-y-2 text-gray-300 text-sm">
                <li>Email: <a href="mailto:info@pellucide.com" class="text-white hover:text-red-400">info@pellucide.com</a></li>
                <li>WhatsApp: <a href="https://wa.me/6281234567890" class="text-white hover:text-red-400">+62 812-3456-7890</a></li>
                <li>Instagram: <a href="https://instagram.com/pellucide.id" class="text-white hover:text-red-400">@pellucide.id</a></li>
                <li>Alamat: Jakarta, Indonesia</li>
            </ul>
        </div>
        <div>
            <h4 class="text-lg font-semibold mb-3">Tautan</h4>
            <ul class="space-y-2 text-gray-300 text-sm">
                <li><a href="{{ route('home') }}" class="hover:text-red-400">Home</a></li>
                <li><a href="{{ route('products.index') }}" class="hover:text-red-400">Produk</a></li>
                <li><a href="#about" class="hover:text-red-400">Tentang</a></li>
                <li><a href="#contact" class="hover:text-red-400">Kontak</a></li>
            </ul>
        </div>
    </div>
    <div class="border-t border-white/10 text-center py-4 text-xs text-gray-400">
        © {{ date('Y') }} Pellucide. All rights reserved.
    </div>
</footer>
