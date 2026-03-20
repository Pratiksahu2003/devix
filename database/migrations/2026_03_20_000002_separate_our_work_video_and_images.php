<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Remove FK/column so images are not related to the video/settings row.
        Schema::table('our_work_images', function (Blueprint $table): void {
            // Laravel will drop the underlying FK constraint for the provided column.
            $table->dropForeign(['our_work_id']);
            $table->dropColumn('our_work_id');
        });
    }

    public function down(): void
    {
        // Re-add the column for rollback (FK will point back to our_works).
        Schema::table('our_work_images', function (Blueprint $table): void {
            $table->foreignId('our_work_id')->nullable()->constrained('our_works')->nullOnDelete();
        });
    }
};

