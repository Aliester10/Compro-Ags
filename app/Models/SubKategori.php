<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubKategori extends Model
{
    use HasFactory;

    protected $table = 'sub_kategori';

    protected $fillable = [
        'name',
        'kategori_id'
    ];

    /**
     * Get the kategori that owns the sub kategori.
     */
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }
    
    /**
     * Get the products for this sub kategori.
     */
    public function produks()
    {
        return $this->hasMany(Produk::class, 'sub_kategori_id');
    }
}