<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('proforma_invoice_id')->constrained('proforma_invoices')->onDelete('cascade');
            $table->string('invoice_number');
            $table->date('invoice_date');
            $table->date('due_date')->nullable();
            $table->decimal('subtotal', 15, 2)->nullable();                // Sub Total
            $table->decimal('ppn', 5, 2)->nullable();                      // PPN (Pajak Pertambahan Nilai)
            $table->decimal('grand_total_include_ppn', 15, 2)->nullable(); // Grand Total setelah PPN
            $table->string('status')->default('unpaid');                   // Status pembayaran, contoh: unpaid, paid
            $table->string('file_path')->nullable();                       // File Invoice
            $table->timestamps();
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
