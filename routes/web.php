<?php

use App\Http\Controllers\InventoryMovementController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'home']);

Route::resource('/inventory-movements', InventoryMovementController::class)
    ->only(['store']);
