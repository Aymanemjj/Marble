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
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('picture')->nullable(true);
            $table->string('banner')->nullable(true);
            $table->text('biography')->nullable(true);
            $table->foreignId('user_id')->nullable(true)->constrained("users");
            $table->foreignId('artist_id')->nullable(true)->constrained("artists");
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
