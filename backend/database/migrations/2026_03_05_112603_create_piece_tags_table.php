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
        Schema::create('piece_tags', function (Blueprint $table) {
            $table->foreignId('tag_id')->nullable(true)->constrained('tags');
            $table->foreignId('piece_id')->nullable(true)->constrained('pieces');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('piece_tags');
    }
};
