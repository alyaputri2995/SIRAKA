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
        Schema::create('rekam_servis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kendaraan_id')->constrained('kendaraans')->cascadeOnDelete();
            $table->foreignId('user_id')->nullable()->constrained('users');
            $table->date('tanggal_servis');
            $table->integer('km_akhir');
            $table->text('keluhan_awal');
            $table->string('diagnosa_awal')->nullable();
            $table->string('diagnosa_akhir')->nullable();
            $table->text('tindakan_servis')->nullable();
            $table->string('status')->default('menunggu_pengerjaan'); // menunggu_pengerjaan, siap_cetak_nota, selesai
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rekam_servis');
    }
};
