<?php

namespace App\Observers;

use App\Models\InventoryMovement;

class InventoryMovementObserver
{
    /**
     * Handle the "creating" event.
     */
    public function creating(InventoryMovement $movement): void
    {
        if ($movement->remaining_quantity === null) {
            // Assign the initial remaining_quantity using the quantity.
            // If the quantity is negative, remaining_quantity should be 0.
            $movement->remaining_quantity = $movement->quantity > 0
                ? $movement->quantity
                : 0;
        }
    }
}
