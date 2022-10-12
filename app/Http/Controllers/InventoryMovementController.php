<?php

namespace App\Http\Controllers;

use App\Http\Requests\InventoryMovements\StoreRequest;
use App\Models\InventoryMovement;
use Illuminate\Http\RedirectResponse;

class InventoryMovementController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request): RedirectResponse
    {
        $data = $request->validated();

        InventoryMovement::create($data);

        return redirect()->back();
    }
}
