<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblTAfterSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_t_after_sales', function (Blueprint $table) {
            $table->id('id_after_sales');
            $table->enum('jenis_layanan', ['Permintaan Data', 'Visit', 'Maintanance', 'Installasi']);
            $table->text('keterangan_layanan')->nullable();
            $table->string('file_pendukung_layanan')->nullable();
            $table->unsignedBigInteger('id_users');
            $table->date('tgl_pengajuan')->nullable();
            $table->enum('flag', ['1', '2', '3', 'N'])->default('1'); // 1 = kirim/open, 2 = progress, 3 = close, N = batal
            $table->text('keterangan_tindakan')->nullable();
            $table->date('tgl_mulai_tindakan')->nullable();
            $table->date('tgl_selesai_tindakan')->nullable();
            $table->string('dok_pendukung_tindakan')->nullable();
            $table->string('tim_teknis')->nullable();
            $table->enum('status', ['open', 'progress', 'close', 'batal'])->default('open');
            $table->timestamps();

            // Foreign key
            $table->foreign('id_users')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_t_after_sales');
    }
}
