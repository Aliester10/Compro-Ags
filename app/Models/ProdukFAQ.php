<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdukFAQ extends Model
{
    use HasFactory;

    protected $table = 'produk_faq';
    

    protected $fillable = ['produk_id', 'pertanyaan', 'jawaban'];

}
