<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    protected $table = 'activities';

    protected $fillable = [
        'title',
        'year',
        'location',
        'description',
        'status',
        'event_date',
        'tanggal_mulai',
        'tanggal_selesai'
    ];

    // Jika ingin format tanggal disimpan dalam format Y-m-d
    protected $dates = [
        'event_date',
        'tanggal_mulai',
        'tanggal_selesai',
        'created_at',
        'updated_at'
    ];

    // Relasi ke tabel gambar aktivitas
    public function images()
    {
        return $this->hasMany(ActivityImage::class);
    }
}