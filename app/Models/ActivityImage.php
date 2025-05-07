<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityImage extends Model
{
    use HasFactory;

    protected $table = 'activity_images';
    
    // Tambahkan baris ini untuk menonaktifkan timestamps
    public $timestamps = false;

    protected $fillable = [
        'activity_id',
        'image'
    ];

    public function activity()
    {
        return $this->belongsTo(Activity::class);
    }
}