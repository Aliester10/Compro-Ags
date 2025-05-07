<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveTaxAndAuthorizedPersonSignatureFromQuotations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('quotations', function (Blueprint $table) {
            // Hapus kolom tax dan authorized_person_signature
            $table->dropColumn(['tax', 'authorized_person_signature']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('quotations', function (Blueprint $table) {
            // Tambahkan kembali kolom jika rollback dilakukan
            $table->decimal('tax', 8, 2)->nullable();
            $table->string('authorized_person_signature')->nullable();
        });
    }
}

