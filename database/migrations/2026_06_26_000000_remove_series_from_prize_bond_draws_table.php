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
        Schema::table('prize_bond_draws', function (Blueprint $table) {
            $table->dropForeign(['prize_bond_series_id']);
            $table->dropColumn('prize_bond_series_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('prize_bond_draws', function (Blueprint $table) {
            $table->foreignId('prize_bond_series_id')->nullable()->after('id')->constrained('prize_bond_series');
        });
    }
};
