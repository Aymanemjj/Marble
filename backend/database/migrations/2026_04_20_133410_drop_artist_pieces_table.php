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
        Schema::dropIfExists('artist_pieces');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::create('artist_piece', function (Blueprint $table) {
            $table->foreignId('artist_id')->constrained();
            $table->foreignId('piece_id')->constrained();
        });
    }
};
