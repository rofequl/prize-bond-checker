<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PrizeBondSeries extends Model
{
    protected $fillable = ['name', 'is_active'];

    public function prizeBonds(): HasMany
    {
        return $this->hasMany(PrizeBond::class);
    }

    public function draws(): HasMany
    {
        return $this->hasMany(PrizeBondDraw::class, 'prize_bond_series_id');
    }
}
