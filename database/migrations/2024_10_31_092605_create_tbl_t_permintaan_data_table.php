<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblTPermintaanDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_t_permintaan_data', function (Blueprint $table) {
            $table->id('id_permintaan_data');
            $table->unsignedBigInteger('id_after_sales');
            $table->string('nama_dokumen');
            $table->string('path_dokumen');
            $table->date('tgl_create')->nullable();
            $table->timestamps();

            // Foreign key
            $table->foreign('id_after_sales')->references('id_after_sales')->on('tbl_t_after_sales')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_t_permintaan_data');
    }
}
