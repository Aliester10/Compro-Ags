<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Monitoring extends Model
{
    use HasFactory;
    protected $table = 'monitoring';


    protected $fillable = ['user_produk_id', 'status_barang', 'kondisi_terakhir_produk'];

    public function userProduk()
    {
        return $this->belongsTo(UserProduk::class);
    }
}
