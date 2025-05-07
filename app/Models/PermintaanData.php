<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermintaanData extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika berbeda dari konvensi default
    protected $table = 'tbl_t_permintaan_data';
    protected $primaryKey = 'id_permintaan_data';

    // Tentukan kolom yang dapat diisi secara massal
    protected $fillable = [
        'id_after_sales',
        'nama_dokumen',
        'path_dokumen',
        'tgl_create',
    ];

    // Relasi ke AfterSales (many-to-one)
    public function afterSales()
    {
        return $this->belongsTo(AfterSales::class, 'id_after_sales');
    }
}
