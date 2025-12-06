<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('size', 50);
            $table->decimal('price', 12, 2);
            $table->string('category', 100);
            $table->text('description')->nullable();
            $table->json('benefits')->nullable();
            $table->string('image')->nullable();
            $table->boolean('is_hot')->default(false);
            $table->boolean('is_active')->default(true);
            $table->string('shopee_link', 500)->nullable();
            $table->string('tokopedia_link', 500)->nullable();
            $table->string('whatsapp_number', 20)->nullable();
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
