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
        Schema::create('nota_transaksis', function (Blueprint $table) {
            $table->id();
            $table->string('no_nota')->unique();
            $table->foreignId('rekam_servis_id')->constrained('rekam_servis')->cascadeOnDelete();
            $table->date('tanggal_cetak');
            $table->decimal('subtotal', 12, 2);
            $table->decimal('diskon', 12, 2)->default(0);
            $table->decimal('total_biaya', 12, 2);
            $table->string('metode_cetak')->default('thermal');
            $table->string('status_pembayaran')->default('lunas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nota_transaksis');
    }
};
