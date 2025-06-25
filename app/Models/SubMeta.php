<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubMeta extends Model
{
    use HasFactory;

    protected $table = 'sub_meta';
    
    protected $fillable = [
        'meta_id',
        'title',
        'image'
    ];

    public function meta()
    {
        return $this->belongsTo(Meta::class);
    }
}