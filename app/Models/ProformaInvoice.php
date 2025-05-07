<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProformaInvoice extends Model
{
    use HasFactory;

    // Tentukan tabel yang digunakan oleh model ini jika namanya tidak konvensional
    protected $table = 'proforma_invoices';

    // Tentukan kolom yang dapat diisi (mass assignable)
    protected $fillable = [
        'purchase_order_id',
        'pi_number',
        'pi_date',
        'subtotal',
        'ppn',
        'grand_total_include_ppn',
        'dp',
        'file_path',
        'remarks',
        'installments',
        'payments_completed',
        'next_payment_amount', // Kolom untuk menyimpan jumlah pembayaran berikutnya
        'dp_invoice_created',

    ];

    /**
     * Relasi ke Purchase Order.
     * Proforma Invoice memiliki satu Purchase Order.
     */
    public function purchaseOrder()
{
    return $this->belongsTo(PurchaseOrder::class, 'purchase_order_id');
}

    public function invoice()
    {
        return $this->hasOne(Invoice::class);
    }
    public function getRemainingPaymentAttribute()
{
    return $this->grand_total_include_ppn - $this->dp;
}
public function getPaymentProofPathsAttribute($value)
{
    return $value ? json_decode($value, true) : [];
}

public function setPaymentProofPathsAttribute($value)
{
    $this->attributes['payment_proof_paths'] = json_encode($value);
}

public function quotation()
{
    return $this->belongsTo(Quotation::class, 'quotation_id');
}
public function getNextPaymentPercentageAttribute($value)
{
    return $value ?: 100; // Default ke 100% jika nilai tidak ada
}

}
