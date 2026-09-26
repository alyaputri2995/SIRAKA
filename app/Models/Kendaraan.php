<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kendaraan extends Model {
    protected $guarded = [];
    public function konsumen() {
        return $this->belongsTo(Konsumen::class);
    }
    public function rekamServis() {
        return $this->hasMany(RekamServis::class);
    }
}