<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class tanggungan extends Model
{
    protected $guarded = ['id'];
    use HasFactory;

    public function peminjam()
    {
        return $this->belongsTo(peminjam::class);
    }

}
