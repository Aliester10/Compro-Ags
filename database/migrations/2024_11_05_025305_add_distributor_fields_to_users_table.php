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
        Schema::table('users', function (Blueprint $table) {
            $table->string('pic')->nullable(); // Person in Charge
            $table->string('nomor_telp_pic')->nullable(); // PIC's Phone Number
            $table->string('akta')->nullable(); // Document for Deed of Establishment
            $table->string('nib')->nullable(); // Document for NIB (Business Identification Number)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('pic');
            $table->dropColumn('nomor_telp_pic');
            $table->dropColumn('akta');
            $table->dropColumn('nib');
        });
    }
};
