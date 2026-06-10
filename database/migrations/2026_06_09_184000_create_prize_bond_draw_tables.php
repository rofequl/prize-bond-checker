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
        Schema::create('prize_bond_draws', function (Blueprint $table) {
            $table->id();
            $table->foreignId('prize_bond_series_id')->constrained('prize_bond_series');
            $table->string('draw_title');
            $table->date('draw_date');
            $table->decimal('first_prize_amount', 14, 2);
            $table->decimal('second_prize_amount', 14, 2);
            $table->decimal('third_prize_amount', 14, 2);
            $table->decimal('fourth_prize_amount', 14, 2);
            $table->decimal('fifth_prize_amount', 14, 2);
            $table->boolean('is_valid')->default(true);
            $table->timestamps();
        });

        Schema::create('prize_bond_draw_winners', function (Blueprint $table) {
            $table->id();
            $table->foreignId('prize_bond_draw_id')->constrained('prize_bond_draws')->cascadeOnDelete();
            $table->string('prize_type');
            $table->string('bond_number');
            $table->timestamps();

            $table->unique(['prize_bond_draw_id', 'prize_type', 'bond_number'], 'draw_prize_number_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prize_bond_draw_winners');
        Schema::dropIfExists('prize_bond_draws');
    }
};
