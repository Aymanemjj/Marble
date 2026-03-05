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
        Schema::create('collage_pieces', function (Blueprint $table) {
            $table->timestamps();
            $table->foreignId('piece_id')->nullable(false)->constrained('pieces');
            $table->foreignId('collage_id')->nullable(false)->constrained('collages');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('collage_pieces');
    }
};
