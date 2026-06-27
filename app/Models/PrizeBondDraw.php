<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PrizeBondDraw extends Model
{
    protected $fillable = [
        'draw_title',
        'draw_date',
        'first_prize_amount',
        'second_prize_amount',
        'third_prize_amount',
        'fourth_prize_amount',
        'fifth_prize_amount',
        'is_valid',
        'result_pdf_path',
    ];

    protected function casts(): array
    {
        return [
            'draw_date' => 'date',
            'first_prize_amount' => 'decimal:2',
            'second_prize_amount' => 'decimal:2',
            'third_prize_amount' => 'decimal:2',
            'fourth_prize_amount' => 'decimal:2',
            'fifth_prize_amount' => 'decimal:2',
            'is_valid' => 'boolean',
        ];
    }

    public function winners(): HasMany
    {
        return $this->hasMany(PrizeBondDrawWinner::class);
    }
}
