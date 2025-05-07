<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QnaGuest extends Model
{
    protected $fillable = [
        'pertanyaan',
        'jawaban',
        'image',
    ];
}
