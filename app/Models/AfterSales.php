<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AfterSales extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika berbeda dari konvensi default
    protected $table = 'tbl_t_after_sales';

    protected $primaryKey = 'id_after_sales';

    // Tentukan kolom yang dapat diisi secara massal
    protected $fillable = [
        'jenis_layanan',
        'keterangan_layanan',
        'file_pendukung_layanan',
        'id_users',
        'tgl_pengajuan',
        'status', // 'flag' in migration terms, representing open, progress, close, etc.
        'keterangan_tindakan',
        'tgl_mulai_tindakan',
        'tgl_selesai_tindakan',
        'dok_pendukung_tindakan',
        'tim_teknis',
    ];

    public $timestamps = true;

    // Relasi dengan user (misalnya satu AfterSales dibuat oleh satu user)
    public function user()
    {
        return $this->belongsTo(User::class, 'id_users');
    }

    // Relasi one-to-many ke tabel permintaan data (tbl_t_permintaan_data)
    public function permintaanData()
    {
        return $this->hasMany(PermintaanData::class, 'id_after_sales');
    }
}
