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
        Schema::create('sliders', function (Blueprint $table) {
            $table->id();
            $table->string('image_url');
            $table->string('title');
            $table->text('description');
            $table->string('title_color')->nullable();
            $table->string('description_color')->nullable();
            $table->boolean('show_specification')->default(false);
            $table->text('specification_text')->nullable();
            $table->string('line_color')->nullable();
            $table->string('specification_color')->nullable();
            $table->boolean('show_button')->default(false);
            $table->string('button_text')->nullable();
            $table->string('button_url')->nullable();
            $table->string('button_text_color')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sliders');
    }
};
