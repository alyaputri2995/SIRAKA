<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Konsumen extends Model {
    protected $guarded = [];
    public function kendaraans() {
        return $this->hasMany(Kendaraan::class);
    }
}