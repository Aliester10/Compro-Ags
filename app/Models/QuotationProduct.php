<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuotationProduct extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika berbeda dari konvensi Laravel
    protected $table = 'quotation_product';

    protected $fillable = [
        'quotation_id',
        'produk_id',
        'quantity',
        'created_at',
        'updated_at',
        'equipment_name',
        'merk_type',
        'unit_price',
        'total_price'
    ];
    

    /**
     * Relasi ke model Quotation
     * Setiap QuotationProduct terkait dengan satu Quotation
     */
    public function quotation()
    {
        return $this->belongsTo(Quotation::class, 'quotation_id');
    }

    /**
     * Relasi ke model Product (atau Produk)
     * Setiap QuotationProduct terkait dengan satu produk
     */
    public function produk()
    {
        return $this->belongsTo(Produk::class, 'produk_id');
    }
    
}
