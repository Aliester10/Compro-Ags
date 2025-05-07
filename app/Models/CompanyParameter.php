<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyParameter extends Model
{
    use HasFactory;

    protected $table = 'compro_parameter';

    // Define the fillable fields
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

    ];

}
