<?php

namespace Tests\Feature\Answers;

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
            'quantity' => 88,
            'unit_price' => 1000,
        ]);

        $this->assertResponse($response);

        $this->assertInventoryMovements();
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
            'id', 'quantity', 'unit_price', 'remaining_quantity',
        ])->toArray());
    }
}
