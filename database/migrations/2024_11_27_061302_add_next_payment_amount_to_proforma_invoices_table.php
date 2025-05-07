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
            $table->decimal('next_payment_amount', 15, 2)->nullable()->after('last_payment_status')->comment('Jumlah pembayaran berikutnya');
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
            $table->dropColumn('next_payment_amount');
        });
    }
};
