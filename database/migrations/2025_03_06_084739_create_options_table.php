<?php

use App\Models\Appartment;
use App\Models\Options;
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
        Schema::create('options', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->timestamps();
        });

        Schema::create('appartment_options', function (Blueprint $table) {
            $table->foreignIdFor(Appartment::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Options::class)->constrained()->cascadeOnDelete();
            $table->primary(['appartment_id', 'options_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appartment_option');
        Schema::dropIfExists('options');
    }
};
