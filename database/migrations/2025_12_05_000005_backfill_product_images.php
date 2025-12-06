<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $products = DB::table('products')
            ->select('id', 'image')
            ->whereNotNull('image')
            ->get();

        foreach ($products as $product) {
            $hasImages = DB::table('product_images')->where('product_id', $product->id)->exists();
            if ($hasImages) {
                continue;
            }

            DB::table('product_images')->insert([
                'product_id' => $product->id,
                'path' => $product->image,
                'sort_order' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    public function down(): void
    {
        // No-op rollback to keep any backfilled images
    }
};
