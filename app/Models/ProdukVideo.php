<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdukVideo extends Model
{
    use HasFactory;

    protected $table = 'produk_video';

    protected $fillable = ['produk_id', 'video',];

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'produk_id');
    }
}
