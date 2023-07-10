<?php

use App\Http\Controllers\ArticleController;
use Illuminate\Support\Facades\Route;

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

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::resource('articles', ArticleController::class)->except(['index', 'show']);
//    Route::resource('articles.comments', CommentController::class)->except(['index', 'show']);
});

Route::resource('articles', ArticleController::class)->only(['index', 'show']);

Route::get('/', function () {
    return to_route('articles.index');
});
