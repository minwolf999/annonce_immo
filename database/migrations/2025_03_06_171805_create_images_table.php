<?php

use App\Models\Appartment;
use App\Models\Image;
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
        Schema::create('images', function (Blueprint $table) {
            $table->id();
            $table->string('path');
            $table->timestamps();
        });

        Schema::create('appartment_image', function (Blueprint $table) {
            $table->foreignIdFor(Appartment::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Image::class)->constrained()->cascadeOnDelete();
            $table->primary(['appartment_id', 'image_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appartment_image');
        Schema::dropIfExists('images');
    }
};
