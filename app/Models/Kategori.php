<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $table = 'kategori';

    protected $fillable = [
        'nama',
        'icon_default',
        'icon_hover',
        'url',
    ];

    public function produk()
    {
        return $this->hasMany(Produk::class);
    }
    /**
     * Get the sub kategoris for the kategori.
     */
    public function bidangPerusahaan()
    {
        return $this->hasMany(BidangPerusahaan::class, 'kategori_id');
    }
}

