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
        Schema::table('pieces', function (Blueprint $table) {
            $table->foreignId('artist_id')->nullable()->constrained();
            $table->renameColumn('creator_id', 'user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pieces', function (Blueprint $table) {

            $table->renameColumn('user_id', 'creator_id');
            $table->dropForeign(['artist_id']);
            $table->dropColumn('artist_id');
        });
    }
};
