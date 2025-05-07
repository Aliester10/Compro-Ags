<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InspeksiMaintenance extends Model
{
    use HasFactory;

    protected $table = 'inspeksi_maintenance';

    protected $fillable = ['user_produk_id', 'pic', 'waktu', 'gambar', 'judul','deskripsi','status'];

    public function userProduk()
    {
        return $this->belongsTo(UserProduk::class, 'user_produk_id');
    }
}
