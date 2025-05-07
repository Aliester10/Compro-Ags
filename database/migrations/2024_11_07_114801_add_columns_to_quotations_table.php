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
            if (!Schema::hasColumn('quotations', 'subtotal_price')) {
                $table->decimal('subtotal_price', 15, 2)->nullable();
            }
            if (!Schema::hasColumn('quotations', 'total_after_discount')) {
                $table->decimal('total_after_discount', 15, 2)->nullable();
            }
            if (!Schema::hasColumn('quotations', 'discount')) {
                $table->decimal('discount', 5, 2)->nullable();
            }
            if (!Schema::hasColumn('quotations', 'ppn')) {
                $table->decimal('ppn', 5, 2)->nullable();
            }
            if (!Schema::hasColumn('quotations', 'grand_total')) {
                $table->decimal('grand_total', 15, 2)->nullable();
            }
            if (!Schema::hasColumn('quotations', 'recipient_company')) {
                $table->string('recipient_company')->nullable();
            }
            if (!Schema::hasColumn('quotations', 'recipient_contact_person')) {
                $table->string('recipient_contact_person')->nullable();
            }
            if (!Schema::hasColumn('quotations', 'quotation_number')) {
                $table->string('quotation_number')->nullable();
            }
            if (!Schema::hasColumn('quotations', 'quotation_date')) {
                $table->date('quotation_date')->nullable();
            }
            if (!Schema::hasColumn('quotations', 'terms_conditions')) {
                $table->text('terms_conditions')->nullable();
            }
            if (!Schema::hasColumn('quotations', 'notes')) {
                $table->text('notes')->nullable();
            }
            if (!Schema::hasColumn('quotations', 'authorized_person_name')) {
                $table->string('authorized_person_name')->nullable();
            }
            if (!Schema::hasColumn('quotations', 'authorized_person_position')) {
                $table->string('authorized_person_position')->nullable();
            }
        });
    }
    
    public function down()
    {
        Schema::table('quotations', function (Blueprint $table) {
            // Anda dapat menghapus kolom jika diperlukan
            $table->dropColumn([
                'subtotal_price',
                'total_after_discount',
                'discount',
                'ppn',
                'grand_total',
                'recipient_company',
                'recipient_contact_person',
                'quotation_number',
                'quotation_date',
                'terms_conditions',
                'notes',
                'authorized_person_name',
                'authorized_person_position'
            ]);
        });
    }
    
};
