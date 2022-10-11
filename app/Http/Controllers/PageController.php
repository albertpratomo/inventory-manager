<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;

class PageController extends Controller
{
    /**
     * Render the home page.
     */
    public function home(): Response
    {
        return Inertia::render('Home', [
        ]);
    }
}
