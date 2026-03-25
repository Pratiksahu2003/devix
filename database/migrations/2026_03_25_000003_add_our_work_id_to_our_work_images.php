<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Fix mismatch: the controller/model insert expects `our_work_id`
        // on `our_work_images`, but an earlier migration dropped it.
        if (!Schema::hasColumn('our_work_images', 'our_work_id')) {
            Schema::table('our_work_images', function (Blueprint $table): void {
                $table->foreignId('our_work_id')
                    ->nullable()
                    ->constrained('our_works')
                    ->cascadeOnDelete();
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('our_work_images', 'our_work_id')) {
            Schema::table('our_work_images', function (Blueprint $table): void {
                try {
                    $table->dropForeign(['our_work_id']);
                } catch (\Throwable $e) {
                    // If the FK doesn't exist in this environment, ignore.
                }

                $table->dropColumn('our_work_id');
            });
        }
    }
};

