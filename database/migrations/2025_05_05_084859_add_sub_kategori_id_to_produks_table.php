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
        Schema::table('produk', function (Blueprint $table) {
            if (!Schema::hasColumn('produk', 'sub_kategori_id')) {
                $table->unsignedBigInteger('sub_kategori_id')->nullable()->after('kategori_id');
                $table->foreign('sub_kategori_id')->references('id')->on('sub_kategori')->onDelete('set null');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('produk', function (Blueprint $table) {
            if (Schema::hasColumn('produk', 'sub_kategori_id')) {
                $table->dropForeign(['sub_kategori_id']);
                $table->dropColumn('sub_kategori_id');
            }
        });
    }
};
