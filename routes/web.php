<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoLISTController;

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

Route::resource('/todolist', TodoLISTController::class);
/* Route::get('/todolist', TodoLISTController::class.'@index');
Route::post('/todolist', TodoLISTController::class.'@store');
Route::put('/todolist/{id}', TodoLISTController::class.'@update');
Route::delete('/todolist/{id}', TodoLISTController::class.'@destroy'); */
