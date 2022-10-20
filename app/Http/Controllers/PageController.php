<?php

namespace App\Http\Controllers;

use App\Http\Resources\InventoryMovementResource;
use App\Models\InventoryMovement;
use Inertia\Inertia;
use Inertia\Response;

class PageController extends Controller
{
    /**
     * Render the home page.
     */
    public function home(): Response
    {
        $movements = InventoryMovement::orderBy('id', 'desc')->get();

        return Inertia::render('Home', [
            'movements' => InventoryMovementResource::collection($movements),
        ]);
    }
}
