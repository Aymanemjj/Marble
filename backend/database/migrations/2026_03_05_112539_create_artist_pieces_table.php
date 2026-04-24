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
        Schema::create('artist_pieces', function (Blueprint $table) {
            $table->timestamps();
            $table->foreignId('artist_id')->nullable(false)->constrained('artists');
            $table->foreignId('piece_id')->nullable(false)->constrained('pieces');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('artist_pieces');
    }
};
