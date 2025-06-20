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
        Schema::create('curse_page_data', function (Blueprint $table) {
            $table->id();
            $table->string('cursName');
            $table->json('purposesInfo');
            $table->json('textGrout');
            $table->integer('price');
            $table->integer('price_month');
            $table->text('firstImage')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('curse_page_data');
    }
};
