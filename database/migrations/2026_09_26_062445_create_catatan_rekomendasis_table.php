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
        Schema::create('catatan_rekomendasis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rekam_servis_id')->constrained('rekam_servis')->cascadeOnDelete();
            $table->text('catatan');
            $table->string('status_konfirmasi')->default('belum'); // belum, sudah
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('catatan_rekomendasis');
    }
};
