<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->seedAdminUser();
        $this->seedProducts();
    }

    protected function seedAdminUser(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@pellucide.com'],
            [
                'name' => 'Admin Pellucide',
                'password' => Hash::make('pellucide2024'),
                'role' => 'admin',
            ]
        );
    }

    protected function seedProducts(): void
    {
        $products = [
            [
                'name' => 'Day Cream',
                'size' => '10 ml',
                'price' => 89000,
                'category' => 'Cream',
                'is_hot' => true,
                'sort_order' => 1,
                'benefits' => [
                    'Mencerahkan Kulit Yang Kusam',
                    'Melembabkan Kulit',
                    'Melindungi Kulit Dari Paparan Sinar UV',
                    'Merawat Kekencangan Kulit',
                    'Menenangkan Kulit Yang Iritasi',
                ],
                'description' => 'Day Cream Pellucide untuk perlindungan kulit siang hari.',
            ],
            [
                'name' => 'Night Cream',
                'size' => '10 ml',
                'price' => 89000,
                'category' => 'Cream',
                'is_hot' => true,
                'sort_order' => 2,
                'benefits' => [
                    'Mencerahkan Wajah',
                    'Membuat Wajah Menjadi Glowing',
                    'Menghilangkan Noda di Wajah',
                    'Melembabkan Kulit Wajah',
                    'Merawat Kekencangan Kulit',
                    'Menghaluskan dan Menutrisi Kulit',
                    'Mencegah Tanda Penuaan Pada Kulit',
                ],
                'description' => 'Night Cream untuk nutrisi maksimal saat tidur.',
            ],
            [
                'name' => 'Facial Wash',
                'size' => '100 ml',
                'price' => 125000,
                'category' => 'Cleanser',
                'is_hot' => true,
                'sort_order' => 3,
                'benefits' => [
                    'Mencerahkan Kulit Secara Maksimal',
                    'Membersihkan Wajah Dari Kotoran, Minyak dan Debu',
                    'Mengangkat Minyak Berlebih',
                ],
                'description' => 'Facial wash lembut untuk kulit bersih dan cerah.',
            ],
            [
                'name' => 'Toner',
                'size' => '100 ml',
                'price' => 99000,
                'category' => 'Toner',
                'is_hot' => true,
                'sort_order' => 4,
                'benefits' => [
                    'Mengecilkan Pori-pori Wajah',
                    'Menyeimbangkan PH Kulit',
                    'Melembabkan dan Menyegarkan Kulit',
                    'Mengurangi Jerawat',
                    'Mendetoksifikasi Kulit',
                ],
                'description' => 'Toner menyeimbangkan pH untuk kulit sehat.',
            ],
            [
                'name' => 'HB Brightening',
                'size' => '100 ml',
                'price' => 149000,
                'category' => 'Serum',
                'sort_order' => 5,
                'benefits' => [
                    'Menjaga Kelembaban Kulit',
                    'Membantu Mencerahkan Warna Kulit',
                    'Merawat Kekencangan Kulit',
                    'Menjaga Elastisitas Kulit',
                    'Melindungi Kulit Dari Efek Buruk Sinar UV',
                ],
                'description' => 'Serum brightening untuk kulit cerah dan lembap.',
            ],
            [
                'name' => 'Vitamin C + Salmon DNA Serum',
                'size' => '10 ml',
                'price' => 175000,
                'category' => 'Serum',
                'sort_order' => 6,
                'benefits' => [
                    'Salmon DNA 10x Lebih Baik Dari Kolagen Biasa',
                    'Menyehatkan Kulit',
                    'Mencerahkan Kulit',
                    'Meratakan Tekstur Kulit',
                    'Menghilangkan Flek Hitam',
                    'Menjaga Kekencangan Kulit',
                    'Menjaga Kekenyalan Kulit',
                ],
                'description' => 'Serum Vitamin C + Salmon DNA untuk kulit sehat bercahaya.',
            ],
            [
                'name' => 'AHA Booster Serum',
                'size' => '10 ml',
                'price' => 165000,
                'category' => 'Serum',
                'sort_order' => 7,
                'benefits' => [
                    'Membantu Merangsang Produksi Kolagen',
                    'Meratakan Warna Kulit',
                    'Membantu Proses Pengelupasan Kulit',
                    'Memudarkan Garis-garis Halus dan Kerut',
                    'Memudarkan Bintik Hitam dan Bekas Luka',
                    'Mengurangi Pembesaran Pori-pori kulit',
                    'Mengurangi Efek Penuaan',
                    'Membantu Efektifitas Penyerapan Zat Aktif Untuk Perawatan Kulit',
                ],
                'description' => 'Booster AHA untuk tekstur kulit lebih halus.',
            ],
            [
                'name' => 'Brightening + Ceramide Serum',
                'size' => '10 ml',
                'price' => 165000,
                'category' => 'Serum',
                'sort_order' => 8,
                'benefits' => [
                    'Melembabkan Kulit',
                    'Menghaluskan Tekstur Kulit',
                    'Memperkuat Lapisan Pelindung Kulit',
                    'Mengurangi Gejala Kulit Kering',
                    'Membuat Kulit Glowy dan Kenyal',
                ],
                'description' => 'Serum ceramide untuk barrier kulit kuat dan lembap.',
            ],
            [
                'name' => 'Eye Cream',
                'size' => '10 ml',
                'price' => 135000,
                'category' => 'Cream',
                'sort_order' => 9,
                'benefits' => [
                    'Meningkatkan Kekencangan Kulit',
                    'Mengurangi Garis Halus di Sekitar Mata',
                    'Meningkatkan Produksi Kolagen',
                    'Meminimalkan dan Mengencangkan Kantung Mata',
                    'Meningkatkan Hidrasi dan Kelembaban Kulit',
                    'Meregenerasi Sel-sel Kulit di Area Sekitar Mata',
                    'Membantu Mencerahkan Area Gelap di Sekitar Mata',
                ],
                'description' => 'Eye cream untuk area mata kencang dan cerah.',
            ],
        ];

        foreach ($products as $data) {
            $product = Product::updateOrCreate(
                ['name' => $data['name']],
                array_merge($data, [
                    'shopee_link' => $data['shopee_link'] ?? 'https://shopee.co.id/pellucide',
                    'tokopedia_link' => $data['tokopedia_link'] ?? 'https://tokopedia.com/pellucide',
                    'whatsapp_number' => $data['whatsapp_number'] ?? '6281234567890',
                ])
            );

            if ($product->images()->count() === 0) {
                $product->images()->create([
                    'path' => $data['image'] ?? 'images/placeholder-product.svg',
                    'sort_order' => 0,
                ]);
            }

            if (!$product->image) {
                $product->update([
                    'image' => $product->images()->orderBy('sort_order')->value('path'),
                ]);
            }
        }
    }
}
