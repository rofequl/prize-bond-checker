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
        Schema::create('prize_bond_series', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('prize_bond_blocks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('prize_bonds', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('prize_bond_block_id')->constrained('prize_bond_blocks')->cascadeOnDelete();
            $table->foreignId('prize_bond_series_id')->constrained('prize_bond_series');
            $table->string('bond_number');
            $table->timestamps();

            $table->unique(['prize_bond_block_id', 'prize_bond_series_id', 'bond_number'], 'block_series_number_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prize_bonds');
        Schema::dropIfExists('prize_bond_blocks');
        Schema::dropIfExists('prize_bond_series');
    }
};
