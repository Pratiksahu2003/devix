<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table): void {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('category')->index();
            $table->string('frame_shape')->nullable()->index();
            $table->string('gender')->nullable()->index();
            $table->string('collection')->nullable()->index();
            $table->unsignedInteger('price_cents');
            $table->string('currency', 3)->default('INR');
            $table->string('primary_image')->nullable();
            $table->json('images')->nullable();
            $table->string('short_description')->nullable();
            $table->text('description')->nullable();
            $table->unsignedInteger('stock')->default(0);
            $table->boolean('is_featured')->default(false)->index();
            $table->string('alt_text')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};

