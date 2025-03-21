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
        Schema::create('appartments', function (Blueprint $table) {
            $table->id();
            
            $table->string('titre');
            $table->string('description');

            $table->integer('surface');
            $table->integer('price');

            $table->integer('piece');
            $table->integer('bedroom');
            $table->integer('floor');
            
            $table->string('address');
            $table->string('city');
            $table->string('postal_code');

            $table->boolean('is_sell');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appartments');
    }
};
