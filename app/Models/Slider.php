<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'image_url',
        'title',
        'title_color',
        'description',
        'description_color',
        'button_text',
        'button_url',
        'button_text_color',
        'show_specification',
        'specification_text',
        'specification_color',
        'line_color',
        'show_button'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'show_specification' => 'boolean',
        'show_button' => 'boolean',
    ];
}