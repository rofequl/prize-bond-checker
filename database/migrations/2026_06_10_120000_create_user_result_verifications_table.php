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
        Schema::create('user_result_verifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('prize_bond_id')->constrained('prize_bonds')->cascadeOnDelete();
            $table->foreignId('prize_bond_block_id')->constrained('prize_bond_blocks')->cascadeOnDelete();
            $table->foreignId('prize_bond_draw_id')->constrained('prize_bond_draws')->cascadeOnDelete();
            $table->string('bond_number');
            $table->string('prize_type');
            $table->decimal('prize_amount', 14, 2);
            $table->string('draw_title');
            $table->date('draw_date');
            $table->timestamps();

            $table->unique(
                ['user_id', 'prize_bond_id', 'prize_bond_draw_id', 'prize_type'],
                'user_bond_draw_prize_unique'
            );
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_result_verifications');
    }
};
