<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class peminjam extends Model
{
    use Sluggable;
    use HasFactory;
    protected $guarded = ['id'];
    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['nim'] ?? false, function ($query, $nim) {
            return $query->Where('nim', $nim);
        });
    }

    public function tanggungan()
    {
        return $this->hasOne(tanggungan::class);
    }

    public function barangs()
    {
        return $this->hasMany(barang::class);
    }



    public function getRouteKeyName()
    {
        return 'kode_peminjaman';
    }


    public function sluggable(): array
    {
        return [
            'kode_peminjaman' => [
                'source' => 'kode_peminjaman'
            ]
        ];
    }
}
