<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComproParameter extends Model
{
    use HasFactory;

    protected $table = 'compro_parameter';
    
    protected $fillable = [
        'email',
        'no_telepon', 
        'no_wa',
        'alamat',
        'maps',
        'visi',
        'misi',
        'logo',
        'instagram',
        'linkedin',
        'ekatalog',
        'nama_perusahaan',
        'sejarah_singkat',
        'about_gambar',
        'whatsapp_1',
        'whatsapp_2',
        'visimisi_1',
        'visimisi_2', 
        'visimisi_3',
        'website',
        'nomor_induk_berusaha',
        'surat_keterangan'
    ];
}