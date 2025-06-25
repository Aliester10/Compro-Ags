<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Meta extends Model
{
    use HasFactory;

    protected $table = 'meta';
    
    protected $fillable = [
        'title',
        'slug',
        'start_date',
        'end_date',
        'image'
    ];

    public function subMetas()
    {
        // Use a custom relation that gets data from the sub_meta table
        return $this->hasMany(SubMeta::class, 'meta_id');
    }
}