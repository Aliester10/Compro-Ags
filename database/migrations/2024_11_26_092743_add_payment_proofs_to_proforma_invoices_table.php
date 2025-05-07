<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPaymentProofsToProformaInvoicesTable extends Migration
{
    public function up()
    {
        Schema::table('proforma_invoices', function (Blueprint $table) {
            $table->text('payment_proof_paths')->nullable(); // Untuk menyimpan JSON dari bukti pembayaran
        });
    }

    public function down()
    {
        Schema::table('proforma_invoices', function (Blueprint $table) {
            $table->dropColumn('payment_proof_paths');
        });
    }
}
