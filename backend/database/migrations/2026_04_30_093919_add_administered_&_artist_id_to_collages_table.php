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
        Schema::table('collages', function (Blueprint $table) {
            $table->foreignId('user_id')->nullable()->change();
            $table->foreignId('artist_id')->nullable()->constrained();
            $table->boolean('administered');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('collages', function (Blueprint $table) {
            $table->dropForeign(['artist_id']);
            $table->dropColumn('artist_id');
            $table->dropColumn('administered');
            $table->foreignId('user_id')->nullable(false)->change();
        });
    }
};
