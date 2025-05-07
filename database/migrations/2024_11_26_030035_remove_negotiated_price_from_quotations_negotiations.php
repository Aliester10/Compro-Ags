<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveNegotiatedPriceFromQuotationsNegotiations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('quotation_negotiations', function (Blueprint $table) {
            $table->dropColumn('negotiated_price');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('quotation_negotiations', function (Blueprint $table) {
            $table->decimal('negotiated_price', 15, 2)->nullable();
        });
    }
}
