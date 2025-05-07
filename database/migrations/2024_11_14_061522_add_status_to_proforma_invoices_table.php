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
        Schema::table('proforma_invoices', function (Blueprint $table) {
            $table->string('status')->default('unpaid')->after('grand_total_include_ppn');
            $table->string('second_payment_proof_path')->nullable()->after('payment_proof_path');
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down()
{
    Schema::table('proforma_invoices', function (Blueprint $table) {
        $table->dropColumn('status');
        $table->dropColumn('second_payment_proof_path');
    });
}
};
