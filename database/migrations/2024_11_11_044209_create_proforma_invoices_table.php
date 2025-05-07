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
        Schema::create('proforma_invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('purchase_order_id')->constrained('purchase_orders')->onDelete('cascade');
            $table->string('pi_number');
            $table->date('pi_date');
            $table->decimal('subtotal', 15, 2)->nullable();                // Sub Total
            $table->decimal('ppn', 5, 2)->nullable();                      // PPN (Pajak Pertambahan Nilai)
            $table->decimal('grand_total_include_ppn', 15, 2)->nullable(); // Grand Total setelah PPN
            $table->decimal('dp', 15, 2)->nullable();                      // DP (Down Payment)
            $table->string('file_path')->nullable();                       // File PI
            $table->timestamps();
        });
    }
    
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proforma_invoices');
    }
};
