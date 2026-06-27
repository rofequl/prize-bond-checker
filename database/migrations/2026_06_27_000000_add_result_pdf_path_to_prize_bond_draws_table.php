<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('prize_bond_draws', function (Blueprint $table) {
            $table->string('result_pdf_path')->nullable()->after('is_valid');
        });
    }

    public function down(): void
    {
        Schema::table('prize_bond_draws', function (Blueprint $table) {
            $table->dropColumn('result_pdf_path');
        });
    }
};
