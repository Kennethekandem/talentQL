<?php

namespace App\Http\Controllers;
use App\Models\Todo;

use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function all() {

        return response()->json(Todo::all());
    }
}
