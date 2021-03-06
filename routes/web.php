<?php

use App\Http\Controllers\AppealController;
use App\Http\Controllers\NewsController;
use App\Http\Middleware\RedirectFromOldSlug;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/news/', [NewsController::class, 'getList'])->name('news_list');
Route::get('/news/{slug}', [NewsController::class, 'getDetails'])->name('news_item');
Route::post('/appeal', [AppealController::class, 'postAppeal'])->name('appeal');
Route::get('/appeal', [AppealController::class, 'getAppealPage'])->name('appeal');
