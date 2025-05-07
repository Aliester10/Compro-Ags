<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentCertificationsProduk extends Model
{
    use HasFactory;

    protected $table = 'document_certifications_produk';

    protected $fillable = [
        'produk_id',
        'pdf',
    ];

    /**
     * Get the product associated with the document certification.
     */
    public function produk()
    {
        return $this->belongsTo(Produk::class, 'produk_id');
    }
}
