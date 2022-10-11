<?php

namespace Database\Seeders;

use App\Models\InventoryMovement;
use Illuminate\Database\Seeder;

class InventoryMovementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'quantity' => 10,
                'unit_price' => 500,
            ],
            [
                'quantity' => 30,
                'unit_price' => 450,
            ],
            [
                'quantity' => -20,
                'unit_price' => null,
            ],
            [
                'quantity' => 10,
                'unit_price' => 500,
            ],
            [
                'quantity' => 34,
                'unit_price' => 450,
            ],
            [
                'quantity' => -25,
                'unit_price' => null,
            ],
            [
                'quantity' => -37,
                'unit_price' => null,
            ],
            [
                'quantity' => 47,
                'unit_price' => 430,
            ],
            [
                'quantity' => -38,
                'unit_price' => null,
            ],
            [
                'quantity' => 10,
                'unit_price' => 500,
            ],
            [
                'quantity' => 50,
                'unit_price' => 420,
            ],
            [
                'quantity' => -28,
                'unit_price' => null,
            ],
            [
                'quantity' => 10,
                'unit_price' => 500,
            ],
            [
                'quantity' => 15,
                'unit_price' => 500,
            ],
            [
                'quantity' => 3,
                'unit_price' => 600,
            ],
            [
                'quantity' => 2,
                'unit_price' => 700,
            ],
            [
                'quantity' => -30,
                'unit_price' => null,
            ],
        ];

        InventoryMovement::factory(count($data))
            ->sequence(...$data)
            ->create();
    }
}
