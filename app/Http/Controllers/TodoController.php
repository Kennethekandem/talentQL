<?php

namespace App\Http\Controllers;
use App\Models\Todo;

use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function all() {

        return response()->json(Todo::all());
    }

    public function create(Request $request) {

        $this->validate($request, [
            'title' => 'required|max:100',
            'description' => 'required'
        ]);

        $create = Todo::create(array(
            'title' => $request['title'],
            'description' => $request['description'],
            'completed' => 0
        ));

        if($create) {
            return response()->json($create);
        }
    }
}
