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
        Schema::table('profiles', function (Blueprint $table) {
            $table->foreignId('fav_piece_id_1')->nullable()->constrained("pieces");
            $table->foreignId('fav_piece_id_2')->nullable()->constrained("pieces");;
        });


        Schema::table('artists', function (Blueprint $table) {
            $table->foreignId('fav_piece_id_1')->nullable()->constrained("pieces");
            $table->foreignId('fav_piece_id_2')->nullable()->constrained("pieces");;
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('profiles', function (Blueprint $table) {
            $table->dropForeign(['fav_piece_id_1']);
            $table->dropForeign(['fav_piece_id_2']);
            $table->dropColumn(['fav_piece_id_1', 'fav_piece_id_2']);
        });

        Schema::table('artists', function (Blueprint $table) {
            $table->dropForeign(['fav_piece_id_1']);
            $table->dropForeign(['fav_piece_id_2']);
            $table->dropColumn(['fav_piece_id_1', 'fav_piece_id_2']);
        });
    }
};
