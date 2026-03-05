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
        Schema::create('artists', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('firstname')->nullable(false);
            $table->string('middlename')->nullable(true);
            $table->string('lastname')->nullable(false);
            $table->date('date_of_birth')->nullable(true);
            $table->date('date_of_death')->nullable(true);
            $table->string('main_medium')->nullable(true);
            $table->string('picture')->nullable(true);
            $table->string('banner')->nullable(true);
            $table->text('biography')->nullable(true);

            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('artists');
    }
};
