<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'quotation_id',    // ID dari quotation terkait
        'user_id',         // ID dari pengguna (distributor) yang membuat PO
        'po_number',       // Nomor unik untuk PO
        'po_date',         // Tanggal PO
        'status',          // Status PO (pending, approved, completed, dll.)
        'file_path',       // Lokasi file PO yang diunggah
    ];

    // Relasi ke model Quotation
    public function quotation()
    {
        return $this->belongsTo(Quotation::class, 'quotation_id');
    }
    

    // Relasi ke model User (distributor yang membuat PO)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function proformaInvoice()
{
    return $this->hasOne(ProformaInvoice::class);
}
}
