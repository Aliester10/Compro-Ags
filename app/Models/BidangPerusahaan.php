<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Schema;

class BidangPerusahaan extends Model
{
    use HasFactory;

    protected $table = 'sub_kategori';
    
    protected $fillable = [
        'name',
        'kategori_id'
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    public function produks()
    {
        // If sub_kategori_id exists in produk table, use it
        if (Schema::hasColumn('produk', 'sub_kategori_id')) {
            return $this->hasMany(Produk::class, 'sub_kategori_id');
        }
        
        // Fallback to using kategori_id (though this may not be accurate)
        return $this->hasMany(Produk::class, 'kategori_id', 'kategori_id');
    }
}