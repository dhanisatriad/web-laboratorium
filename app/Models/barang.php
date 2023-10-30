<?php

namespace App\Models;


use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class barang extends Model
{

    use Sluggable;
    use HasFactory;
    protected $guarded = ['id'];
    public function scopeFilter($query, array $filters)
    {

        $query->when($filters['kode'] ?? false, function ($query, $kode) {
            return $query->Where('kode_barang', $kode);
        });

        $query->when($filters['pinjam'] ?? false, function ($query, $pinjam) {
            $nama = explode(',', $pinjam);
            return $query->WhereIN('nama_barang', $nama);
        });

        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->Where('nama_barang', 'like', "%{$search}%");
        });

        $query->When($filters['laboratorium'] ?? false, function ($query, $laboratorium) {
            return $query->wherehas('laboratorium', function ($query) use ($laboratorium) {
                $query->where('slug', $laboratorium);
            });
        });

        $query->When($filters['lokasi'] ?? false, function ($query, $lokasi) {
            return $query->wherehas('lokasi_penyimpanan', function ($query) use ($lokasi) {
                $query->where('slug', $lokasi);
            });
        });



    }

    public function laboratorium()
    {
        return $this->belongsTo(laboratorium::class);
    }


    public function peminjam()
    {
        return $this->belongsTo(peminjam::class);
    }

    public function lokasi_penyimpanan()
    {
        return $this->belongsTo(lokasi_penyimpanan::class);
    }

    public function getRouteKeyName()
    {
        return 'kode_barang';
    }

    public function sluggable(): array
    {
        return [
            'kode_barang' => [
                'source' => 'kode_barang'
            ]
        ];
    }

}
