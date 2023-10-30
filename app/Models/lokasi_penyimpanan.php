<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class lokasi_penyimpanan extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function barangs()
    {
        return $this->hasMany(barang::class);
    }

    public function getRouteKeyName()
    {
        return 'kode_lokasi';
    }
}
