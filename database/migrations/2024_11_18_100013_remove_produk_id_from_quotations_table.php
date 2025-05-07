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
            // First, drop the foreign key constraint
            $table->dropForeign(['produk_id']);
            
            // Then, drop the column itself
            $table->dropColumn('produk_id');
        });
    }
    
    public function down()
    {
        Schema::table('quotations', function (Blueprint $table) {
            // If you rollback, add the 'produk_id' column back with the foreign key constraint
            $table->foreignId('produk_id')->constrained()->onDelete('cascade');
        });
    }
    
};