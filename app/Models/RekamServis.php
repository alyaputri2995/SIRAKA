<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RekamServis extends Model {
    protected $guarded = [];
    public function kendaraan() {
        return $this->belongsTo(Kendaraan::class);
    }
    public function detailSpareparts() {
        return $this->hasMany(DetailSparepart::class);
    }
    public function detailJasas() {
        return $this->hasMany(DetailJasa::class);
    }
    public function nota() {
        return $this->hasOne(NotaTransaksi::class);
    }
}