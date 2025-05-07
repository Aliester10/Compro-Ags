<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveStatusFromProformaInvoicesTable extends Migration
{
    /**
     * Jalankan migrasi untuk menghapus kolom status.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('proforma_invoices', function (Blueprint $table) {
            if (Schema::hasColumn('proforma_invoices', 'status')) {
                $table->dropColumn('status');
            }
        });
    }

    /**
     * Rollback migrasi untuk menambahkan kembali kolom status.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('proforma_invoices', function (Blueprint $table) {
            $table->enum('status', ['approved', 'rejected'])->default('approved');
        });
    }
}
