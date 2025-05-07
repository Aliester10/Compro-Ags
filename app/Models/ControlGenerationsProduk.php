<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ControlGenerationsProduk extends Model
{
    use HasFactory;

    protected $table = 'control_generations_produk';

    protected $fillable = [
        'produk_id',
        'pdf',
    ];

    /**
     * Get the product associated with the control generation.
     */
    public function produk()
    {
        return $this->belongsTo(Produk::class, 'produk_id');
    }
}
