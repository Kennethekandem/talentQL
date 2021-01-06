<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;
use App\Models\Todo;

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

Route::prefix('todos')->group(function() {
    Route::get('/all', [TodoController::class, 'all']);

    Route::post('/create', [TodoController::class, 'create']);

    Route::get('/todo/{todo}', function(Todo $todo) {
        return response()->json($todo);
    });
});
