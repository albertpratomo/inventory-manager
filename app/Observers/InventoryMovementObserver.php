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

        // If quantity is negative, that means user wants to apply some inventory.
        if ($movement->quantity < 0) {
            $quantityOut = abs($movement->quantity);

            // $this->validateInventoryIsSufficient($quantityOut);

            // Apply from available (remaining) inventory until $quantityOut is satisfied.
            while ($quantityOut > 0) {
                $inventory = InventoryMovement::available()->oldest()->first();

                $remainingQuantity = $inventory->remaining_quantity - $quantityOut;

                if ($remainingQuantity < 0) {
                    $quantityOut = abs($remainingQuantity);

                    $remainingQuantity = 0;
                } else {
                    $quantityOut = 0;
                }

                $inventory->update(['remaining_quantity' => $remainingQuantity]);
            }
        }
    }
}
