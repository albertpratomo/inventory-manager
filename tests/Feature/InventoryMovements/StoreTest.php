<?php

namespace Tests\Feature\InventoryMovements;

use App\Models\InventoryMovement;
use Database\Seeders\InventoryMovementSeederSimple;
use Illuminate\Testing\TestResponse;
use Tests\Concerns\AssertsInertia;
use Tests\TestCase;

class StoreTest extends TestCase
{
    use AssertsInertia;

    /** @test */
    public function user_can_purchase_inventory(): void
    {
        $this->seed(InventoryMovementSeederSimple::class);

        $response = $this->makeRequest([
            'quantity' => 1,
            'unitPrice' => 1000,
        ]);

        $this->assertResponse($response);

        $this->assertInventoryMovements();
    }

    /** @test */
    public function user_cant_purchase_inventory_no_unit_price(): void
    {
        $response = $this->makeRequest([
            'quantity' => 1,
        ]);

        $this->assertSession($response, ['errors']);

        $this->assertDatabaseCount('inventory_movements', 0);
    }

    /** @test */
    public function user_can_apply_inventory(): void
    {
        $this->seed(InventoryMovementSeederSimple::class);

        $response = $this->makeRequest([
            'quantity' => -2,
            'unitPrice' => null,
        ]);

        $this->assertResponse($response);

        $this->assertInventoryMovements();
    }

    /** @test */
    public function user_cant_apply_inventory_if_insufficient(): void
    {
        $this->seed(InventoryMovementSeederSimple::class);

        $response = $this->makeRequest([
            'quantity' => -6,
            'unitPrice' => null,
        ]);

        $this->assertSession($response, ['errors']);

        $this->assertInventoryMovements();
    }

    /** @test */
    public function user_cant_apply_inventory_0_quantity(): void
    {
        $response = $this->makeRequest([
            'quantity' => 0,
            'unitPrice' => 0,
        ]);

        $this->assertSession($response, ['errors']);

        $this->assertDatabaseCount('inventory_movements', 0);
    }

    private function makeRequest(array $data): TestResponse
    {
        return $this->post('inventory-movements', $data);
    }

    private function assertResponse(TestResponse $response): void
    {
        $response->assertRedirect('/')
            ->assertSessionHasNoErrors();
    }

    private function assertInventoryMovements(): void
    {
        $this->assertMatchesJsonSnapshot(InventoryMovement::all([
            'id', 'quantity', 'unit_price', 'total_price', 'remaining_quantity',
        ])->toArray());
    }
}
