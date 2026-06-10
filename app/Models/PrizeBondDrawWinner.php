<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PrizeBondDrawWinner extends Model
{
    protected $fillable = ['prize_bond_draw_id', 'prize_type', 'bond_number'];

    public function draw(): BelongsTo
    {
        return $this->belongsTo(PrizeBondDraw::class, 'prize_bond_draw_id');
    }
}
