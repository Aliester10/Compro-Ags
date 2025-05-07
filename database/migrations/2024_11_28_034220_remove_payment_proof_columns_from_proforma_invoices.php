<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemovePaymentProofColumnsFromProformaInvoices extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::table('proforma_invoices', function (Blueprint $table) {
        if (Schema::hasColumn('proforma_invoices', 'payment_proof_path')) {
            $table->dropColumn('payment_proof_path');
        }
        if (Schema::hasColumn('proforma_invoices', 'second_payment_proof_path')) {
            $table->dropColumn('second_payment_proof_path');
        }
        if (Schema::hasColumn('proforma_invoices', 'payment_proof_amounts')) {
            $table->dropColumn('payment_proof_amounts');
        }
    });
}


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('proforma_invoices', function (Blueprint $table) {
            // Tambahkan kembali kolom yang dihapus jika rollback dilakukan
            $table->string('payment_proof_path')->nullable();
            $table->string('second_payment_proof_path')->nullable();
            $table->json('payment_proof_amounts')->nullable();
        });
    }
}
