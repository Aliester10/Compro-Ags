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
        Schema::create('inspeksi_maintenance', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_produk_id')->constrained('user_produk')->onDelete('cascade');
            $table->string('pic'); // person in charge
            $table->timestamp('waktu'); // visit time
            $table->string('gambar')->nullable(); // image path, made nullable
            $table->string('judul'); 
            $table->string('deskripsi'); 
            $table->enum('status', ['Inspeksi', 'Maintenance']);

            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inspeksi_maintenance');
    }
};
