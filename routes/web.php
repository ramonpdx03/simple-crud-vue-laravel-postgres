<?php

use App\Http\Controllers\SimpleCrudController;
use Illuminate\Support\Facades\Route;

## ROUTES
Route::get('/', [SimpleCrudController::class, 'index']);

## AXIOS
Route::post('/produto/cadastrar', [SimpleCrudController::class, 'cadastrarProduto']);
Route::post('/produto/{id}/disponivel', [SimpleCrudController::class, 'setProdutoDisponivel']);
Route::post('/produto/{id}/excluir', [SimpleCrudController::class, 'excluirProduto']);
Route::post('/produto/{id}/editar', [SimpleCrudController::class, 'editarProduto']);
