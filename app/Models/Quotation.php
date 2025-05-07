<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Produk;

class Quotation extends Model
{
    use HasFactory;

    // Specify the fillable attributes for mass assignment
    protected $fillable = [
        'user_id', 
        'produk_id', 
        'quantity', 
        'status',
        'recipient_company',
        'recipient_contact_person',
        'quotation_number',
        'quotation_date',
        'subtotal_price',
        'discount',
        'total_after_discount',
        'ppn',
        'grand_total',
        'notes',
        'terms_conditions',
        'authorized_person_name',
        'authorized_person_position',
        'nomor_pengajuan',
        'topik',
        'pdf_path' // Tambahkan kolom pdf_path

    ];
    

    /**
     * Define relationship with the User model.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Define relationship with the Produk model.
     * Assuming 'produk_id' is the foreign key that links to the Produk model.
     */
    public function produk()
    {
        return $this->belongsTo(Produk::class, 'produk_id');
    }
    public function quotationProducts()
    {
        return $this->hasMany(QuotationProduct::class, 'quotation_id');
    }
    // Relasi ke model QuotationNegotiation
    public function negotiation()
{
    return $this->hasOne(QuotationNegotiation::class, 'quotation_id');
}

public function purchaseOrder()
{
    return $this->hasOne(PurchaseOrder::class, 'quotation_id');
}
}

