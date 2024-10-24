<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;

class SimpleCrudController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('SimpleCrud');
    }
}