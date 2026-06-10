<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PrizeBond extends Model
{
    protected $fillable = ['user_id', 'prize_bond_block_id', 'prize_bond_series_id', 'bond_number'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function block(): BelongsTo
    {
        return $this->belongsTo(PrizeBondBlock::class, 'prize_bond_block_id');
    }

    public function series(): BelongsTo
    {
        return $this->belongsTo(PrizeBondSeries::class, 'prize_bond_series_id');
    }
}
