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
        Schema::create('produk', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('merk');
            $table->text('kegunaan');
            $table->string('user_manual')->nullable();
            $table->enum('via', ['labtek', 'labverse']);
            $table->foreignId('sub_kategori_id')
            ->nullable() // Make it nullable initially for existing records
            ->constrained('sub_kategori')
            ->onDelete('cascade');
            $table->foreignId('kategori_id')
            ->nullable() // Make it nullable initially for existing records
            ->constrained('kategori')
            ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produk');
    }
};