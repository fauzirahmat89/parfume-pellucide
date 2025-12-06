# 📋 INSTRUKSI PEMBUATAN WEBSITE PELLUCIDE
## Website E-Commerce Skincare dengan Laravel 11 + Blade

---

## 🎯 RINGKASAN PROYEK

**Nama Brand:** Pellucide (분명한 - Korea: "Jernih/Murni")  
**Jenis Produk:** Skincare Premium  
**Target Market:** Indonesia (Iklim Tropis)  
**Teknologi:** Laravel 11 + Blade Template + Tailwind CSS + Alpine.js  
**Database:** MySQL  

---

## 📦 DATA PRODUK PELLUCIDE

### Daftar 9 Produk Utama:

| No | Nama Produk | Ukuran | Kategori | Harga (Est.) |
|----|-------------|--------|----------|--------------|
| 1 | Day Cream | 10 ml | Cream | Rp 89.000 |
| 2 | Night Cream | 10 ml | Cream | Rp 89.000 |
| 3 | Facial Wash | 100 ml | Cleanser | Rp 125.000 |
| 4 | Toner | 100 ml | Toner | Rp 99.000 |
| 5 | HB Brightening | 100 ml | Serum | Rp 149.000 |
| 6 | Vitamin C + Salmon DNA Serum | 10 ml | Serum | Rp 175.000 |
| 7 | AHA Booster Serum | 10 ml | Serum | Rp 165.000 |
| 8 | Brightening + Ceramide Serum | 10 ml | Serum | Rp 165.000 |
| 9 | Eye Cream | 10 ml | Cream | Rp 135.000 |

### Detail Benefit Setiap Produk:

#### 1. Day Cream (10 ml)
```
- Mencerahkan Kulit Yang Kusam
- Melembabkan Kulit
- Melindungi Kulit Dari Paparan Sinar UV
- Merawat Kekencangan Kulit
- Menenangkan Kulit Yang Iritasi
```

#### 2. Night Cream (10 ml)
```
- Mencerahkan Wajah
- Membuat Wajah Menjadi Glowing
- Menghilangkan Noda di Wajah
- Melembabkan Kulit Wajah
- Merawat Kekencangan Kulit
- Menghaluskan dan Menutrisi Kulit
- Mencegah Tanda Penuaan Pada Kulit
```

#### 3. Facial Wash (100 ml)
```
- Mencerahkan Kulit Secara Maksimal
- Membersihkan Wajah Dari Kotoran, Minyak dan Debu
- Mengangkat Minyak Berlebih
```

#### 4. Toner (100 ml)
```
- Mengecilkan Pori-pori Wajah
- Menyeimbangkan PH Kulit
- Melembabkan dan Menyegarkan Kulit
- Mengurangi Jerawat
- Mendetoksifikasi Kulit
```

#### 5. HB Brightening (100 ml)
```
- Menjaga Kelembaban Kulit
- Membantu Mencerahkan Warna Kulit
- Merawat Kekencangan Kulit
- Menjaga Elastisitas Kulit
- Melindungi Kulit Dari Efek Buruk Sinar UV
```

#### 6. Vitamin C + Salmon DNA Serum (10 ml)
```
- Salmon DNA 10x Lebih Baik Dari Kolagen Biasa
- Menyehatkan Kulit
- Mencerahkan Kulit
- Meratakan Tekstur Kulit
- Menghilangkan Flek Hitam
- Menjaga Kekencangan Kulit
- Menjaga Kekenyalan Kulit
```

#### 7. AHA Booster Serum (10 ml)
```
- Membantu Merangsang Produksi Kolagen
- Meratakan Warna Kulit
- Membantu Proses Pengelupasan Kulit
- Memudarkan Garis-garis Halus dan Kerut
- Memudarkan Bintik Hitam dan Bekas Luka
- Mengurangi Pembesaran Pori-pori kulit
- Mengurangi Efek Penuaan
- Membantu Efektifitas Penyerapan Zat Aktif Untuk Perawatan Kulit
```

#### 8. Brightening + Ceramide Serum (10 ml)
```
- Melembabkan Kulit
- Menghaluskan Tekstur Kulit
- Memperkuat Lapisan Pelindung Kulit
- Mengurangi Gejala Kulit Kering
- Membuat Kulit Glowy dan Kenyal
```

#### 9. Eye Cream (10 ml)
```
- Meningkatkan Kekencangan Kulit
- Mengurangi Garis Halus di Sekitar Mata
- Meningkatkan Produksi Kolagen
- Meminimalkan dan Mengencangkan Kantung Mata
- Meningkatkan Hidrasi dan Kelembaban Kulit
- Meregenerasi Sel-sel Kulit di Area Sekitar Mata
- Membantu Mencerahkan Area Gelap di Sekitar Mata
```

### Keunggulan Produk Pellucide:
```
1. AMAN - Teruji klinis dan dermatologically tested
2. COCOK UNTUK IKLIM TROPIS - Diformulasikan khusus untuk Indonesia
3. UNISEX - Dapat digunakan pria dan wanita
4. KUALITAS ULTIMATE DENGAN HARGA TERJANGKAU
5. BERIJIN EDAR BPOM & HAKI
```

---

## 👥 SISTEM USER & ROLE

### Role yang Tersedia:

| Role | Akses | Keterangan |
|------|-------|------------|
| **Pengunjung** | Public | Melihat landing page, produk, detail produk |
| **Admin** | Protected | CRUD produk, kelola hot products, dashboard |

### Kredensial Admin Default:
```
Email: admin@pellucide.com
Password: pellucide2024
```

---

## 🗂️ STRUKTUR DATABASE

### Tabel: `users`
```sql
CREATE TABLE users (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'user') DEFAULT 'user',
    remember_token VARCHAR(100) NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
);
```

### Tabel: `products`
```sql
CREATE TABLE products (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    slug VARCHAR(255) UNIQUE NOT NULL,
    size VARCHAR(50) NOT NULL,
    price DECIMAL(12,2) NOT NULL,
    category VARCHAR(100) NOT NULL,
    description TEXT NULL,
    benefits JSON NULL,  -- Array of benefits
    image VARCHAR(255) NULL,
    is_hot BOOLEAN DEFAULT FALSE,
    is_active BOOLEAN DEFAULT TRUE,
    shopee_link VARCHAR(500) NULL,
    tokopedia_link VARCHAR(500) NULL,
    whatsapp_number VARCHAR(20) NULL,
    sort_order INT DEFAULT 0,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
);
```

### Tabel: `settings`
```sql
CREATE TABLE settings (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    key VARCHAR(255) UNIQUE NOT NULL,
    value TEXT NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
);
```

---

## 📁 STRUKTUR FOLDER LARAVEL

```
pellucide/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── HomeController.php
│   │   │   ├── ProductController.php
│   │   │   └── Admin/
│   │   │       ├── DashboardController.php
│   │   │       ├── ProductController.php
│   │   │       └── AuthController.php
│   │   └── Middleware/
│   │       └── AdminMiddleware.php
│   └── Models/
│       ├── User.php
│       ├── Product.php
│       └── Setting.php
├── resources/
│   └── views/
│       ├── layouts/
│       │   ├── app.blade.php          # Layout utama public
│       │   └── admin.blade.php        # Layout admin
│       ├── components/
│       │   ├── navbar.blade.php
│       │   ├── footer.blade.php
│       │   ├── product-card.blade.php
│       │   └── carousel.blade.php
│       ├── home.blade.php             # Landing page
│       ├── products/
│       │   ├── index.blade.php        # Semua produk
│       │   └── show.blade.php         # Detail produk
│       └── admin/
│           ├── login.blade.php        # Hidden login
│           ├── dashboard.blade.php
│           └── products/
│               ├── index.blade.php
│               ├── create.blade.php
│               └── edit.blade.php
├── routes/
│   └── web.php
└── public/
    └── images/
        └── products/
```

---

## 🛣️ ROUTING (routes/web.php)

```php
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES
|--------------------------------------------------------------------------
*/

// Landing Page
Route::get('/', [HomeController::class, 'index'])->name('home');

// Products
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{slug}', [ProductController::class, 'show'])->name('products.show');

/*
|--------------------------------------------------------------------------
| ADMIN ROUTES - Hidden Login URL
|--------------------------------------------------------------------------
*/

// Hidden Admin Login (URL rahasia)
Route::get('/pellucide-admin-secret', [AuthController::class, 'showLogin'])->name('admin.login');
Route::post('/pellucide-admin-secret', [AuthController::class, 'login'])->name('admin.login.submit');
Route::post('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout');

// Protected Admin Routes
Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    
    // Product Management
    Route::resource('products', AdminProductController::class)->names([
        'index' => 'admin.products.index',
        'create' => 'admin.products.create',
        'store' => 'admin.products.store',
        'edit' => 'admin.products.edit',
        'update' => 'admin.products.update',
        'destroy' => 'admin.products.destroy',
    ]);
    
    // Toggle Hot Product (AJAX)
    Route::patch('/products/{product}/toggle-hot', [AdminProductController::class, 'toggleHot'])
        ->name('admin.products.toggle-hot');
    
    // Toggle Active Status (AJAX)
    Route::patch('/products/{product}/toggle-active', [AdminProductController::class, 'toggleActive'])
        ->name('admin.products.toggle-active');
});
```

---

## 🎨 DESIGN SYSTEM

### Warna Brand Pellucide:
```css
:root {
    /* Primary Colors */
    --color-primary: #1a1a1a;        /* Hitam Elegan */
    --color-secondary: #2d2d2d;      /* Abu Gelap */
    --color-accent: #dc2626;         /* Merah (dari logo 분명한) */
    
    /* Neutral Colors */
    --color-dark: #0f0f0f;
    --color-gray: #6b7280;
    --color-light: #f5f5f5;
    --color-white: #ffffff;
    
    /* Gradient */
    --gradient-dark: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 100%);
    --gradient-elegant: linear-gradient(180deg, #1a1a1a 0%, #0f0f0f 100%);
}
```

### Typography:
```css
/* Headings - Elegant Serif */
font-family: 'Playfair Display', serif;

/* Body - Clean Sans */
font-family: 'Poppins', sans-serif;

/* Brand Name Script */
font-family: 'Great Vibes', cursive; /* Untuk logo "Pellucide" */
```

### Tailwind Config Extension:
```javascript
// tailwind.config.js
module.exports = {
    theme: {
        extend: {
            colors: {
                'pellucide': {
                    'black': '#1a1a1a',
                    'dark': '#0f0f0f',
                    'gray': '#2d2d2d',
                    'red': '#dc2626',
                    'gold': '#d4af37',
                }
            },
            fontFamily: {
                'display': ['Playfair Display', 'serif'],
                'body': ['Poppins', 'sans-serif'],
                'script': ['Great Vibes', 'cursive'],
            }
        }
    }
}
```

---

## 📄 HALAMAN & KOMPONEN

### 1. LANDING PAGE (`home.blade.php`)

#### Struktur Sections:
```
┌─────────────────────────────────────────┐
│              NAVBAR                      │
├─────────────────────────────────────────┤
│                                         │
│            HERO SECTION                 │
│    (Brand intro + CTA button)           │
│                                         │
├─────────────────────────────────────────┤
│                                         │
│         HOT PRODUCTS SECTION            │
│    (Max 4 produk unggulan dengan        │
│     badge "HOT" - dipilih admin)        │
│                                         │
├─────────────────────────────────────────┤
│                                         │
│         PRODUCT CAROUSEL                │
│    (Slider interaktif semua produk)     │
│    [<] [Product Cards] [>]              │
│                                         │
├─────────────────────────────────────────┤
│                                         │
│         ALL PRODUCTS GRID               │
│    (Grid 3-4 kolom semua produk)        │
│    [View All Products Button]           │
│                                         │
├─────────────────────────────────────────┤
│                                         │
│         WHY PELLUCIDE SECTION           │
│    (Keunggulan: BPOM, Tropis, dll)      │
│                                         │
├─────────────────────────────────────────┤
│              FOOTER                      │
└─────────────────────────────────────────┘
```

#### Hero Section Content:
```html
<!-- Hero Text -->
<h1>Pellucide</h1>
<p class="korean">분명한</p>
<p class="tagline">Premium Korean-Inspired Skincare for Tropical Skin</p>
<p class="subtitle">Kecantikan yang Jernih, Kulit yang Bercahaya</p>

<!-- CTA Buttons -->
<a href="#products">Lihat Produk</a>
<a href="#hot-products">Best Sellers</a>
```

### 2. PRODUCT CARD COMPONENT

```html
<!-- resources/views/components/product-card.blade.php -->
<div class="product-card group">
    <!-- Hot Badge (conditional) -->
    @if($product->is_hot)
        <span class="hot-badge">🔥 HOT</span>
    @endif
    
    <!-- Product Image -->
    <div class="image-wrapper">
        <img src="{{ $product->image_url }}" alt="{{ $product->name }}">
        <div class="overlay">
            <a href="{{ route('products.show', $product->slug) }}">
                Lihat Detail
            </a>
        </div>
    </div>
    
    <!-- Product Info -->
    <div class="product-info">
        <span class="category">{{ $product->category }}</span>
        <h3>{{ $product->name }}</h3>
        <p class="size">{{ $product->size }}</p>
        <p class="price">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
    </div>
    
    <!-- Quick Buy Buttons -->
    <div class="buy-buttons">
        <a href="{{ $product->shopee_link }}" class="btn-shopee">
            Shopee
        </a>
        <a href="{{ $product->tokopedia_link }}" class="btn-tokped">
            Tokopedia
        </a>
        <a href="https://wa.me/{{ $product->whatsapp_number }}" class="btn-wa">
            WhatsApp
        </a>
    </div>
</div>
```

### 3. DETAIL PRODUCT PAGE (`products/show.blade.php`)

```
┌─────────────────────────────────────────┐
│              NAVBAR                      │
├─────────────────────────────────────────┤
│                                         │
│  ┌─────────────┐  ┌──────────────────┐  │
│  │             │  │ PRODUCT NAME     │  │
│  │   PRODUCT   │  │ Category | Size  │  │
│  │   IMAGE     │  │                  │  │
│  │   (Large)   │  │ Rp XXX.XXX       │  │
│  │             │  │                  │  │
│  │             │  │ BENEFITS:        │  │
│  │             │  │ ✓ Benefit 1      │  │
│  │             │  │ ✓ Benefit 2      │  │
│  │             │  │ ✓ Benefit 3      │  │
│  │             │  │                  │  │
│  └─────────────┘  │ [Shopee] [Tokped]│  │
│                   │ [WhatsApp Order] │  │
│                   └──────────────────┘  │
│                                         │
├─────────────────────────────────────────┤
│         PRODUCT DESCRIPTION             │
├─────────────────────────────────────────┤
│         RELATED PRODUCTS                │
├─────────────────────────────────────────┤
│              FOOTER                      │
└─────────────────────────────────────────┘
```

### 4. ADMIN LOGIN PAGE (Hidden)

**URL Akses:** `/pellucide-admin-secret`

```
┌─────────────────────────────────────────┐
│                                         │
│         ┌───────────────────┐           │
│         │                   │           │
│         │    🔐 ADMIN       │           │
│         │                   │           │
│         │  Email:           │           │
│         │  [____________]   │           │
│         │                   │           │
│         │  Password:        │           │
│         │  [____________]   │           │
│         │                   │           │
│         │  [  LOGIN  ]      │           │
│         │                   │           │
│         └───────────────────┘           │
│                                         │
└─────────────────────────────────────────┘
```

### 5. ADMIN DASHBOARD

```
┌─────────────────────────────────────────┐
│  ADMIN SIDEBAR    │   MAIN CONTENT      │
├───────────────────┼─────────────────────┤
│                   │                     │
│  📊 Dashboard     │   STATISTICS        │
│  📦 Products      │   ┌───┐ ┌───┐ ┌───┐ │
│  ⚙️ Settings      │   │ 9 │ │ 3 │ │ 6 │ │
│                   │   │Pro│ │Hot│ │Act│ │
│  ─────────────    │   └───┘ └───┘ └───┘ │
│                   │                     │
│  👤 Admin         │   RECENT PRODUCTS   │
│  🚪 Logout        │   [Table list...]   │
│                   │                     │
└───────────────────┴─────────────────────┘
```

### 6. ADMIN PRODUCT MANAGEMENT

#### Product List Table:
```
┌────┬─────────┬──────────┬────────┬─────┬────────┬─────────┐
│ No │ Image   │ Name     │ Price  │ Hot │ Active │ Actions │
├────┼─────────┼──────────┼────────┼─────┼────────┼─────────┤
│ 1  │ [img]   │ Day Cream│ 89.000 │ 🔥  │ ✅     │ ✏️ 🗑️  │
│ 2  │ [img]   │ Night... │ 89.000 │ ⭕  │ ✅     │ ✏️ 🗑️  │
└────┴─────────┴──────────┴────────┴─────┴────────┴─────────┘

[+ Tambah Produk Baru]
```

#### Product Form (Create/Edit):
```
┌─────────────────────────────────────────┐
│         FORM PRODUK                     │
├─────────────────────────────────────────┤
│                                         │
│  Nama Produk *                          │
│  [_________________________________]    │
│                                         │
│  Ukuran *              Kategori *       │
│  [___________]         [Dropdown___]    │
│                                         │
│  Harga (Rp) *                           │
│  [_________________________________]    │
│                                         │
│  Gambar Produk                          │
│  [Choose File] atau [URL gambar]        │
│                                         │
│  Deskripsi                              │
│  [_________________________________]    │
│  [_________________________________]    │
│                                         │
│  Benefits (pisahkan dengan Enter)       │
│  [_________________________________]    │
│  [_________________________________]    │
│                                         │
│  ═══════ LINK PEMBELIAN ═══════         │
│                                         │
│  🛒 Link Shopee                         │
│  [_________________________________]    │
│                                         │
│  🛒 Link Tokopedia                      │
│  [_________________________________]    │
│                                         │
│  📱 Nomor WhatsApp (format: 628xxx)     │
│  [_________________________________]    │
│                                         │
│  ═══════ PENGATURAN ═══════             │
│                                         │
│  [✓] Jadikan Hot Product                │
│  [✓] Aktifkan Produk                    │
│                                         │
│  [    SIMPAN    ]  [    BATAL    ]      │
│                                         │
└─────────────────────────────────────────┘
```

---

## 🔧 IMPLEMENTASI KODE

### Model: Product.php
```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'size',
        'price',
        'category',
        'description',
        'benefits',
        'image',
        'is_hot',
        'is_active',
        'shopee_link',
        'tokopedia_link',
        'whatsapp_number',
        'sort_order',
    ];

    protected $casts = [
        'benefits' => 'array',
        'is_hot' => 'boolean',
        'is_active' => 'boolean',
        'price' => 'decimal:2',
    ];

    // Auto-generate slug
    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($product) {
            $product->slug = Str::slug($product->name);
        });
        
        static::updating(function ($product) {
            if ($product->isDirty('name')) {
                $product->slug = Str::slug($product->name);
            }
        });
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeHot($query)
    {
        return $query->where('is_hot', true);
    }

    // Accessors
    public function getImageUrlAttribute()
    {
        if ($this->image && str_starts_with($this->image, 'http')) {
            return $this->image;
        }
        return $this->image 
            ? asset('storage/products/' . $this->image) 
            : asset('images/placeholder-product.png');
    }

    public function getFormattedPriceAttribute()
    {
        return 'Rp ' . number_format($this->price, 0, ',', '.');
    }

    public function getWhatsappLinkAttribute()
    {
        $message = urlencode("Halo, saya tertarik dengan produk {$this->name} Pellucide. Apakah masih tersedia?");
        return "https://wa.me/{$this->whatsapp_number}?text={$message}";
    }
}
```

### Controller: HomeController.php
```php
<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Hot Products (max 4)
        $hotProducts = Product::active()
            ->hot()
            ->orderBy('sort_order')
            ->take(4)
            ->get();

        // All Products for carousel and grid
        $products = Product::active()
            ->orderBy('sort_order')
            ->get();

        // Group by category
        $categories = Product::active()
            ->select('category')
            ->distinct()
            ->pluck('category');

        return view('home', compact('hotProducts', 'products', 'categories'));
    }
}
```

### Controller: Admin/ProductController.php
```php
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('sort_order')->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = ['Cream', 'Cleanser', 'Toner', 'Serum'];
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'size' => 'required|string|max:50',
            'price' => 'required|numeric|min:0',
            'category' => 'required|string|max:100',
            'description' => 'nullable|string',
            'benefits' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'image_url' => 'nullable|url',
            'is_hot' => 'boolean',
            'is_active' => 'boolean',
            'shopee_link' => 'nullable|url',
            'tokopedia_link' => 'nullable|url',
            'whatsapp_number' => 'nullable|string|max:20',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')
                ->store('products', 'public');
        } elseif ($request->filled('image_url')) {
            $validated['image'] = $request->image_url;
        }

        // Convert benefits string to array
        if ($request->filled('benefits')) {
            $validated['benefits'] = array_filter(
                array_map('trim', explode("\n", $request->benefits))
            );
        }

        Product::create($validated);

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Produk berhasil ditambahkan!');
    }

    public function edit(Product $product)
    {
        $categories = ['Cream', 'Cleanser', 'Toner', 'Serum'];
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        // Similar to store with update logic
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'size' => 'required|string|max:50',
            'price' => 'required|numeric|min:0',
            'category' => 'required|string|max:100',
            'description' => 'nullable|string',
            'benefits' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'image_url' => 'nullable|url',
            'is_hot' => 'boolean',
            'is_active' => 'boolean',
            'shopee_link' => 'nullable|url',
            'tokopedia_link' => 'nullable|url',
            'whatsapp_number' => 'nullable|string|max:20',
        ]);

        // Handle image
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($product->image && !str_starts_with($product->image, 'http')) {
                Storage::disk('public')->delete($product->image);
            }
            $validated['image'] = $request->file('image')
                ->store('products', 'public');
        } elseif ($request->filled('image_url')) {
            $validated['image'] = $request->image_url;
        }

        // Convert benefits
        if ($request->filled('benefits')) {
            $validated['benefits'] = array_filter(
                array_map('trim', explode("\n", $request->benefits))
            );
        }

        $product->update($validated);

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Produk berhasil diperbarui!');
    }

    public function destroy(Product $product)
    {
        // Delete image if exists
        if ($product->image && !str_starts_with($product->image, 'http')) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Produk berhasil dihapus!');
    }

    // AJAX Toggle Hot Product
    public function toggleHot(Product $product)
    {
        $product->update(['is_hot' => !$product->is_hot]);

        return response()->json([
            'success' => true,
            'is_hot' => $product->is_hot,
            'message' => $product->is_hot 
                ? 'Produk ditandai sebagai HOT' 
                : 'Status HOT produk dihapus'
        ]);
    }

    // AJAX Toggle Active Status
    public function toggleActive(Product $product)
    {
        $product->update(['is_active' => !$product->is_active]);

        return response()->json([
            'success' => true,
            'is_active' => $product->is_active,
            'message' => $product->is_active 
                ? 'Produk diaktifkan' 
                : 'Produk dinonaktifkan'
        ]);
    }
}
```

### Middleware: AdminMiddleware.php
```php
<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->check() || auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized access.');
        }

        return $next($request);
    }
}
```

---

## 🎨 BLADE TEMPLATES

### Layout: app.blade.php
```blade
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Pellucide - Premium Korean-Inspired Skincare for Tropical Skin">
    <title>@yield('title', 'Pellucide - 분명한')</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&family=Playfair+Display:wght@400;500;600;700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    @stack('styles')
</head>
<body class="bg-gray-50 font-body">
    <!-- Navbar -->
    @include('components.navbar')
    
    <!-- Main Content -->
    <main>
        @yield('content')
    </main>
    
    <!-- Footer -->
    @include('components.footer')
    
    @stack('scripts')
</body>
</html>
```

### Component: navbar.blade.php
```blade
<nav class="fixed w-full z-50 bg-pellucide-black/95 backdrop-blur-sm" x-data="{ open: false }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-20">
            <!-- Logo -->
            <a href="{{ route('home') }}" class="flex items-center space-x-2">
                <span class="font-script text-3xl text-white">Pellucide</span>
                <span class="text-pellucide-red text-sm">분명한</span>
            </a>
            
            <!-- Desktop Menu -->
            <div class="hidden md:flex items-center space-x-8">
                <a href="{{ route('home') }}" class="text-white hover:text-pellucide-red transition">Home</a>
                <a href="{{ route('products.index') }}" class="text-white hover:text-pellucide-red transition">Products</a>
                <a href="#about" class="text-white hover:text-pellucide-red transition">About</a>
                <a href="#contact" class="text-white hover:text-pellucide-red transition">Contact</a>
            </div>
            
            <!-- Mobile Menu Button -->
            <button @click="open = !open" class="md:hidden text-white">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path x-show="!open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    <path x-show="open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
    </div>
    
    <!-- Mobile Menu -->
    <div x-show="open" x-transition class="md:hidden bg-pellucide-dark">
        <div class="px-4 py-4 space-y-3">
            <a href="{{ route('home') }}" class="block text-white py-2">Home</a>
            <a href="{{ route('products.index') }}" class="block text-white py-2">Products</a>
            <a href="#about" class="block text-white py-2">About</a>
            <a href="#contact" class="block text-white py-2">Contact</a>
        </div>
    </div>
</nav>
```

### Component: carousel.blade.php
```blade
<div class="relative" x-data="carousel()">
    <!-- Carousel Container -->
    <div class="overflow-hidden">
        <div class="flex transition-transform duration-500 ease-out"
             :style="{ transform: `translateX(-${currentSlide * 100}%)` }">
            @foreach($products->chunk(3) as $chunk)
                <div class="w-full flex-shrink-0 grid grid-cols-1 md:grid-cols-3 gap-6 px-4">
                    @foreach($chunk as $product)
                        @include('components.product-card', ['product' => $product])
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>
    
    <!-- Navigation Arrows -->
    <button @click="prev()" 
            class="absolute left-0 top-1/2 -translate-y-1/2 bg-pellucide-black/80 text-white p-3 rounded-full hover:bg-pellucide-red transition">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
        </svg>
    </button>
    <button @click="next()" 
            class="absolute right-0 top-1/2 -translate-y-1/2 bg-pellucide-black/80 text-white p-3 rounded-full hover:bg-pellucide-red transition">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
        </svg>
    </button>
    
    <!-- Dots Indicator -->
    <div class="flex justify-center mt-6 space-x-2">
        @foreach($products->chunk(3) as $index => $chunk)
            <button @click="goTo({{ $index }})"
                    :class="currentSlide === {{ $index }} ? 'bg-pellucide-red' : 'bg-gray-400'"
                    class="w-3 h-3 rounded-full transition"></button>
        @endforeach
    </div>
</div>

<script>
function carousel() {
    return {
        currentSlide: 0,
        totalSlides: {{ $products->chunk(3)->count() }},
        
        next() {
            this.currentSlide = (this.currentSlide + 1) % this.totalSlides;
        },
        
        prev() {
            this.currentSlide = (this.currentSlide - 1 + this.totalSlides) % this.totalSlides;
        },
        
        goTo(index) {
            this.currentSlide = index;
        },
        
        // Auto-play (optional)
        init() {
            setInterval(() => this.next(), 5000);
        }
    }
}
</script>
```

---

## 🔐 FITUR KEAMANAN

### 1. Hidden Admin URL
- URL login admin tidak menggunakan `/admin/login` standar
- Gunakan URL rahasia: `/pellucide-admin-secret`
- Tidak ada link ke halaman login admin di frontend

### 2. CSRF Protection
```blade
<!-- Semua form harus include CSRF token -->
<form method="POST" action="...">
    @csrf
    <!-- form fields -->
</form>
```

### 3. Rate Limiting (LoginController)
```php
// Di AuthController@login
if ($this->hasTooManyLoginAttempts($request)) {
    $this->fireLockoutEvent($request);
    return $this->sendLockoutResponse($request);
}
```

### 4. Password Hashing
```php
// Selalu hash password
'password' => Hash::make($request->password)
```

---

## 📱 RESPONSIVE BREAKPOINTS

```css
/* Mobile First Approach */
/* Default: Mobile */

/* Tablet */
@media (min-width: 768px) { /* md */ }

/* Desktop */
@media (min-width: 1024px) { /* lg */ }

/* Large Desktop */
@media (min-width: 1280px) { /* xl */ }
```

---

## ⚙️ INSTALASI & SETUP

### 1. Clone & Install Dependencies
```bash
composer create-project laravel/laravel pellucide
cd pellucide
composer install
npm install
```

### 2. Environment Setup
```bash
cp .env.example .env
php artisan key:generate
```

### 3. Database Configuration
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=parfumepellucide
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Run Migrations & Seeders
```bash
php artisan migrate
php artisan db:seed
```

### 5. Storage Link
```bash
php artisan storage:link
```

### 6. Build Assets
```bash
npm run dev  # Development
npm run build  # Production
```

### 7. Run Server
```bash
php artisan serve
```

---

## 📝 SEEDER DATA

### DatabaseSeeder.php
```php
<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Create Admin User
        User::create([
            'name' => 'Admin Pellucide',
            'email' => 'admin@pellucide.com',
            'password' => Hash::make('pellucide2024'),
            'role' => 'admin',
        ]);

        // Create Products
        $products = [
            [
                'name' => 'Day Cream',
                'size' => '10 ml',
                'price' => 89000,
                'category' => 'Cream',
                'is_hot' => true,
                'benefits' => [
                    'Mencerahkan Kulit Yang Kusam',
                    'Melembabkan Kulit',
                    'Melindungi Kulit Dari Paparan Sinar UV',
                    'Merawat Kekencangan Kulit',
                    'Menenangkan Kulit Yang Iritasi'
                ],
                'description' => 'Day Cream Pellucide untuk perlindungan kulit siang hari.',
                'shopee_link' => 'https://shopee.co.id/pellucide',
                'tokopedia_link' => 'https://tokopedia.com/pellucide',
                'whatsapp_number' => '6281234567890',
            ],
            // ... tambahkan 8 produk lainnya
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
```

---

## ✅ CHECKLIST FITUR

### Public Pages:
- [ ] Landing page dengan hero section
- [ ] Hot products section (max 4, dengan badge 🔥)
- [ ] Product carousel interaktif
- [ ] Grid semua produk
- [ ] Halaman detail produk
- [ ] Link Shopee, Tokopedia, WhatsApp di setiap produk
- [ ] Navbar responsive
- [ ] Footer dengan info kontak

### Admin Panel:
- [ ] Hidden login URL (`/pellucide-admin-secret`)
- [ ] Dashboard dengan statistik
- [ ] CRUD produk lengkap
- [ ] Upload gambar produk
- [ ] Toggle Hot Product (AJAX)
- [ ] Toggle Active/Inactive (AJAX)
- [ ] Input link Shopee, Tokopedia, WhatsApp
- [ ] Logout functionality

### Technical:
- [ ] Responsive design (mobile-first)
- [ ] Form validation
- [ ] CSRF protection
- [ ] Image optimization
- [ ] SEO meta tags
- [ ] Loading states

---

## 🎯 CATATAN PENTING

1. **URL Admin Rahasia**: Gunakan `/pellucide-admin-secret` bukan `/admin`
2. **Nomor WhatsApp**: Format internasional tanpa + (contoh: `6281234567890`)
3. **Hot Products**: Maksimal 4 produk yang ditampilkan di section hot
4. **Gambar**: Support upload file dan URL eksternal
5. **Benefits**: Input sebagai textarea, pisahkan per baris

---

## 📞 INFORMASI KONTAK DEFAULT

```
Brand: Pellucide (분명한)
Email: info@pellucide.com
WhatsApp: +62 812-3456-7890
Instagram: @pellucide.id
Alamat: Jakarta, Indonesia
```

---

*Dokumen ini dibuat untuk memudahkan AI dalam membangun website Pellucide dengan Laravel + Blade.*
