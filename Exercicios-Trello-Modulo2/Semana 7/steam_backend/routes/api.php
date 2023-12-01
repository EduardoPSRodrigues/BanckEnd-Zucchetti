<?php

use App\Http\Controllers\AchievementController;
use App\Http\Controllers\AssetController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductRequirementController;
use Illuminate\Support\Facades\Route;

Route::get('products', [ProductController::class, 'index']);
Route::post('products', [ProductController::class, 'store']);
Route::get('products/{id}', [ProductController::class, 'show']);
Route::delete('products/{id}', [ProductController::class, 'destroy']);
Route::put('products/{id}', [ProductController::class, 'update']);

Route::get('categories', [CategoryController::class, 'index']);
Route::post('categories', [CategoryController::class, 'store']);
Route::get('categories/{id}', [CategoryController::class, 'show']);
Route::delete('categories/{id}', [CategoryController::class, 'destroy']);
Route::put('categories/{id}', [CategoryController::class, 'update']);

Route::get('achievements', [AchievementController::class, 'index']);
Route::post('achievements', [AchievementController::class, 'store']);
Route::delete('achievements/{id}', [AchievementController::class, 'destroy']);
Route::put('achievements/{id}', [AchievementController::class, 'update']);

Route::get('products_requirements', [ProductRequirementController::class, 'index']);
Route::post('products_requirements', [ProductRequirementController::class, 'store']);
Route::delete('products_requirements/{id}', [ProductRequirementController::class, 'destroy']);
Route::put('products_requirements/{id}', [ProductRequirementController::class, 'update']);

Route::get('asset', [AssetController::class, 'index']);
Route::post('asset', [AssetController::class, 'store']);
Route::put('asset/{id}', [AssetController::class, 'update']);
Route::delete('asset/{id}', [AssetController::class, 'destroy']);
