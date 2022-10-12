<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryMovement extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'quantity', 'unit_price', 'remaining_quantity',
    ];

    /**
     * Scope only InventoryMovements that still has remaining quantity.
     */
    public function scopeAvailable(Builder $query): Builder
    {
        return $query->where('quantity', '>', 0)
            ->where('remaining_quantity', '>', 0);
    }
}
