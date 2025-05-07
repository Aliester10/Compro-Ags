<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuotationNegotiation extends Model
{
    use HasFactory;

    // Nama tabel (jika tidak sesuai dengan default plural Laravel)
    protected $table = 'quotation_negotiations';

    // Kolom yang dapat diisi (mass assignable)
    protected $fillable = [
        'quotation_id',
        'status',
        'notes',
        'admin_notes',
    ];

    // Relasi ke model Quotation
    public function quotation()
    {
        return $this->belongsTo(Quotation::class, 'quotation_id');
    }
}
