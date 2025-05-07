<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAdminNotesToQuotationNegotiationsTable extends Migration
{
    public function up()
    {
        Schema::table('quotation_negotiations', function (Blueprint $table) {
            $table->text('admin_notes')->nullable()->after('notes');
        });
    }

    public function down()
    {
        Schema::table('quotation_negotiations', function (Blueprint $table) {
            $table->dropColumn('admin_notes');
        });
    }
}
