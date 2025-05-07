<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'proforma_invoice_id',
        'invoice_number',
        'invoice_date',
        'subtotal',
        'ppn',
        'grand_total_include_ppn',
        'percentage',
        'status',
        'file_path',
        'type',
        
    ];

    public function proformaInvoice()
    {
        return $this->belongsTo(ProformaInvoice::class);
    }

// Relasi ke PurchaseOrder melalui ProformaInvoice
public function purchaseOrder()
{
    return $this->hasOneThrough(PurchaseOrder::class, ProformaInvoice::class, 'id', 'id', 'proforma_invoice_id', 'purchase_order_id');
}

}
