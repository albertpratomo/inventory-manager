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
        // If quantity is positive, that means user wants to purchase inventory.
        if ($movement->quantity > 0) {
            $movement->remaining_quantity = $movement->quantity;

            $movement->total_price = $movement->quantity * $movement->unit_price;
        }

        // If quantity is negative, that means user wants to apply inventory.
        if ($movement->quantity < 0) {
            $movement->remaining_quantity = 0;

            $quantityOut = abs($movement->quantity);

            $totalPrice = 0;

            // Apply from available (remaining) inventory until $quantityOut is satisfied.
            while ($quantityOut > 0) {
                $inventory = InventoryMovement::available()->oldest()->first();

                $remainingQuantity = $inventory->remaining_quantity - $quantityOut;

                if ($remainingQuantity < 0) {
                    // At this point $inventory is used up, but $quantityOut hasn't been
                    // satisfied. So assign the remainder as the new $quantityOut.
                    $quantityOut = abs($remainingQuantity);

                    $totalPrice += $inventory->remaining_quantity * $inventory->unit_price;

                    $remainingQuantity = 0;
                } else {
                    $totalPrice += $quantityOut * $inventory->unit_price;

                    // At this point $quantityOut has been satisfied, so $quantityOut should
                    // be updated to 0 to exit the loop.
                    $quantityOut = 0;
                }

                $inventory->update(['remaining_quantity' => $remainingQuantity]);
            }

            // Store the total price and unit price of this outbound movement.
            $movement->total_price = $totalPrice;

            $movement->unit_price = round($totalPrice / abs($movement->quantity));
        }
    }
}
