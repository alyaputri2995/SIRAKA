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
        Schema::create('detail_spareparts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rekam_servis_id')->constrained('rekam_servis')->cascadeOnDelete();
            $table->foreignId('sparepart_id')->constrained('spareparts');
            $table->integer('qty');
            $table->decimal('harga_modal_saat_transaksi', 12, 2);
            $table->decimal('harga_jual_saat_transaksi', 12, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_spareparts');
    }
};
