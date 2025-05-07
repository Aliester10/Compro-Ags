<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Doctrine\DBAL\Types\Type;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Jika masih mengalami masalah dengan kolom type, jalankan migrasi ini
        // Pastikan package doctrine/dbal sudah diinstall: 
        // composer require doctrine/dbal
        
        Schema::table('brand_partner', function (Blueprint $table) {
            // Mengubah kolom type dari ENUM menjadi VARCHAR
            $table->string('type', 20)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('brand_partner', function (Blueprint $table) {
            // Mengembalikan ke ENUM
            $table->enum('type', ['brand', 'principal', 'distributor', 'ecommerce'])->default('brand')->change();
        });
    }
};