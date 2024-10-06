<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/', [MainController::class, 'index']) -> name('main_without_session');

Route::get('/about', [MainController::class, 'about']) -> name('about_without_session');

Route::get('/news', [MainController::class, 'news']) -> name('news_without_session');

Route::get('/session_reset', [MainController::class, 'session_reset']) -> name('session_reset');


Route::get('/{sity}', [MainController::class, 'index_session']) -> name('main_with_session');

Route::get('/{sity}/about', [MainController::class, 'about_session']) -> name('about_with_session');

Route::get('/{sity}/news', [MainController::class, 'news_session']) -> name('news_with_session');
