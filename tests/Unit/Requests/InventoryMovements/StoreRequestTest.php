<?php

namespace Tests\Unit\Requests\InventoryMovements;

use App\Http\Requests\InventoryMovements\StoreRequest;
use Tests\Unit\Requests\TestCase;

class StoreRequestTest extends TestCase
{
    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->prepareFormRequest(StoreRequest::class);
    }

    /** @test */
    public function it_matches_snapshot(): void
    {
        $this->assertRulesSnapshot();
    }

    /** @test */
    public function it_fails_when_quantity_0(): void
    {
        $this->assertFails([
            'quantity' => 0,
        ]);
    }

    /** @test */
    public function it_fails_when_quantity_positive_but_unit_price_unsupplied(): void
    {
        $this->assertFails([
            'quantity' => 1,
        ]);
    }
}
