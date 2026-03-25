<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('our_work_videos', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('our_work_id')
                ->constrained('our_works')
                ->cascadeOnDelete();

            $table->string('youtube_url');
            $table->integer('sort_order')->default(0)->index();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('our_work_videos');
    }
};

