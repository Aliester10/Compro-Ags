<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BrandPartner extends Model
{
    use HasFactory;

    protected $table = 'brand_partner';

    // Mass assignable attributes
    protected $fillable = [
        'gambar',
        'type',
        'url',
        'nama',
    ];
    
    // Tambahkan casting untuk type
    protected $casts = [
        'type' => 'string',
    ];
    
    // Mutator untuk memastikan nilai type disimpan dengan benar
    public function setTypeAttribute($value)
    {
        $this->attributes['type'] = trim(strval($value));
    }
    
    // Mutator untuk memastikan nilai gambar disimpan dengan benar
    public function setGambarAttribute($value)
    {
        $this->attributes['gambar'] = trim(strval($value));
    }
}