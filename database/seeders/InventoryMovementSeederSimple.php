<?php

namespace Database\Seeders;

use App\Models\InventoryMovement;
use Illuminate\Database\Seeder;

class InventoryMovementSeederSimple extends Seeder
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
                'quantity' => 1,
                'unit_price' => 1000,
            ],
            [
                'quantity' => 2,
                'unit_price' => 2000,
            ],
            [
                'quantity' => 2,
                'unit_price' => 1500,
            ],
        ];

        InventoryMovement::factory(count($data))
            ->sequence(...$data)
            ->create();
    }
}
