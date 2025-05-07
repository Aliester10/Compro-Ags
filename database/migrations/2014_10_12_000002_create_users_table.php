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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('no_telp')->nullable();
            $table->string('alamat')->nullable();
            $table->string('nama_perusahaan')->nullable();
            $table->boolean('type')->default(false); //add type boolean Users: 0=>User, 1=>Admin, 2=>Manager
            $table->unsignedBigInteger('bidang_id')->nullable(); // Buat kolom ini nullable
            $table->unsignedBigInteger('location_id')->nullable();
            $table->string('gender')->nullable()->after('verified');
            $table->date('date_of_birth')->nullable()->after('gender');
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('bidang_id')->references('id')->on('bidang_perusahaan')->onDelete('cascade');
            $table->foreign('location_id')->references('id')->on('locations')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
