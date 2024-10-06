<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiSityController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/sities/refresh', [ApiSityController::class, 'refresh'])->name('sities_refresh');

Route::post('/sities/add', [ApiSityController::class, 'add'])->name('sities_add');

Route::post('/sities/delete', [ApiSityController::class, 'delete'])->name('sities_delete');
