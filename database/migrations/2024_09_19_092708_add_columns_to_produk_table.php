<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('produk', function (Blueprint $table) {
            $table->string('tipe')->nullable()->after('user_manual');
            $table->string('link')->nullable()->after('tipe');
            $table->text('deskripsi')->nullable()->after('kegunaan');
            $table->text('spesifikasi')->nullable()->after('deskripsi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('produk', function (Blueprint $table) {
            $table->dropColumn('tipe');
            $table->dropColumn('link');
            $table->dropColumn('deskripsi');
            $table->dropColumn('spesifikasi');
        });
    }
};
