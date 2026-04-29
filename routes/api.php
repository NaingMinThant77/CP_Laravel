<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// category CRUD
// Route::get('/categories', [CategoryController::class, 'index']);
// Route::get('/categories/{id}', [CategoryController::class, 'show']);
// Route::post('/categories', [CategoryController::class, 'store']);
// Route::put('/categories/{id}', [CategoryController::class, 'update']);
// Route::delete('/categories/{id}', [CategoryController::class, 'destroy']);

Route::apiResource('categories', CategoryController::class);

// product CRUD
Route::apiResource('products', ProductController::class);