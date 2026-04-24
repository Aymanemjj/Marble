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
        Schema::create('artist_users', function (Blueprint $table) {
            $table->timestamps();
            $table->foreignId('user_id')->nullable(false)->constrained('users');
            $table->foreignId('following_id')->nullable(false)->constrained('artists');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('artist_users');
    }
};
