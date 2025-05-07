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
        Schema::table('quotations', function (Blueprint $table) {
            $table->string('topik', 255)->nullable()->after('nomor_pengajuan');
        });
    }
    
    public function down()
    {
        Schema::table('quotations', function (Blueprint $table) {
            $table->dropColumn('topik');
        });
    }
    
};
