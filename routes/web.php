<?php

use App\Http\Controllers\SimpleCrudController;
use Illuminate\Support\Facades\Route;

## ROUTES
Route::get('/', [SimpleCrudController::class, 'index']);
