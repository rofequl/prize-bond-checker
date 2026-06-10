<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserResultVerification extends Model
{
    protected $fillable = [
        'user_id',
        'prize_bond_id',
        'prize_bond_block_id',
        'prize_bond_draw_id',
        'bond_number',
        'prize_type',
        'prize_amount',
        'draw_title',
        'draw_date',
    ];

    protected function casts(): array
    {
        return [
            'prize_amount' => 'decimal:2',
            'draw_date' => 'date',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function block(): BelongsTo
    {
        return $this->belongsTo(PrizeBondBlock::class, 'prize_bond_block_id');
    }

    public function bond(): BelongsTo
    {
        return $this->belongsTo(PrizeBond::class, 'prize_bond_id');
    }

    public function draw(): BelongsTo
    {
        return $this->belongsTo(PrizeBondDraw::class, 'prize_bond_draw_id');
    }
}
