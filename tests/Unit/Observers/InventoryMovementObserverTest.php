<?php

namespace Tests\Unit\Observers;

use App\Models\InventoryMovement;
use Database\Seeders\InventoryMovementSeederSimple;
use Tests\TestCase;

class InventoryMovementObserverTest extends TestCase
{
    /** @test */
    public function applying_inventory_decrements_remaining_quantity_of_previous_entries(): void
    {
        // Purchase 5 units in different prices.
        $this->seed(InventoryMovementSeederSimple::class);

        // Apply 2 units.
        InventoryMovement::factory()->create([
            'quantity' => -2,
            'unit_price' => null,
        ]);

        // Assert that the remaining_quantity of previous InventoryMovements
        // are decremented correctly, also total_price is calculated correctly.
        $this->assertMatchesJsonSnapshot(InventoryMovement::all([
            'id', 'quantity', 'unit_price', 'total_price', 'remaining_quantity',
        ])->toArray());
    }
}
