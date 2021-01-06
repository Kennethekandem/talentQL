<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;
use App\Models\Todo;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::prefix('todos')->group(function() {

    // fetch all todo list
    Route::get('/all', [TodoController::class, 'all']);

    // create a new todo
    Route::post('/create', [TodoController::class, 'create']);

    // fetch a single todo
    Route::get('/todo/{id}', function(Todo $id) {
        return response()->json($id);
    });

    // update todo
    Route::post('/update/{id}', [TodoController::class, 'update']);

    // delete todo
    Route::delete('/delete/{id}', [TodoController::class, 'delete']);

});
