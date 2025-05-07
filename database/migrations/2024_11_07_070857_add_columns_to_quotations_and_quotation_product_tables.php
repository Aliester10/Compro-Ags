<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        // Menambahkan kolom baru di tabel quotations
        Schema::table('quotations', function (Blueprint $table) {
            $table->string('quotation_number')->unique()->nullable();
            $table->date('quotation_date')->nullable();
            $table->string('recipient_company')->nullable();
            $table->string('recipient_contact_person')->nullable();
            $table->string('discount')->nullable();
            $table->string('tax')->nullable();
            $table->decimal('grand_total', 15, 2)->nullable();
            $table->text('terms_conditions')->nullable();
            $table->text('notes')->nullable();
            $table->string('authorized_person_name')->nullable();
            $table->string('authorized_person_position')->nullable();
            $table->string('authorized_person_signature')->nullable(); // Referensi untuk tanda tangan jika diperlukan
        });

        // Menambahkan kolom baru di tabel quotation_product
        Schema::table('quotation_product', function (Blueprint $table) {
            $table->string('equipment_name')->nullable();
            $table->string('merk_type')->nullable();
            $table->decimal('unit_price', 15, 2)->nullable();
            $table->decimal('total_price', 15, 2)->nullable();
        });
    }

    public function down()
    {
        // Menghapus kolom baru dari tabel quotations
        Schema::table('quotations', function (Blueprint $table) {
            $table->dropColumn([
                'quotation_number',
                'quotation_date',
                'recipient_company',
                'recipient_contact_person',
                'discount',
                'tax',
                'grand_total',
                'terms_conditions',
                'notes',
                'authorized_person_name',
                'authorized_person_position',
                'authorized_person_signature',
            ]);
        });

        // Menghapus kolom baru dari tabel quotation_product
        Schema::table('quotation_product', function (Blueprint $table) {
            $table->dropColumn([
                'equipment_name',
                'merk_type',
                'unit_price',
                'total_price',
            ]);
        });
    }
};

