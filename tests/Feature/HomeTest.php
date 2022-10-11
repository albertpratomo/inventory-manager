<?php

namespace Tests\Feature;

use Database\Seeders\InventoryMovementSeederSimple;
use Tests\Concerns\AssertsInertia;
use Tests\TestCase;

class HomeTest extends TestCase
{
    use AssertsInertia;

    /** @test */
    public function user_can_view_home_page()
    {
        $this->seed(InventoryMovementSeederSimple::class);

        $response = $this->get('/');

        $this->assertInertia($response, 'Home');
    }
}
