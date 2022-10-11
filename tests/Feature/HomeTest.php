<?php

namespace Tests\Feature;

use Tests\Concerns\AssertsInertia;
use Tests\TestCase;

class HomeTest extends TestCase
{
    use AssertsInertia;

    /** @test */
    public function user_can_view_home_page()
    {
        $response = $this->get('/');

        $this->assertInertia($response, 'Home', true);
    }
}
