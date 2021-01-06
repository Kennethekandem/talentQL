<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Todo;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class TodoController extends Controller
{
    public function all() {

        return response()->json(Todo::all());
    }

    public function create(Request $request) {

        $request->validate([
            'title' => 'required|max:100',
            'description' => 'required'
        ]);

        $create = Todo::create(array(
            'title' => $request['title'],
            'description' => $request['description'],
            'completed' => 0
        ));

        if($create) {
            return response()->json([
                'status_code' => 200,
                'message' => 'Todo created successfully',
                'data' => $create
            ]);
        }
    }

    public function update(Request $request, $id) {

        $update = Todo::findOrFail($id)->update($request->all());

        if($update) {
            $todo = Todo::find($id);

            return response()->json([
                'status_code' => 200,
                'message' => 'Todo updated successfully',
                'data' => $todo
            ]);
        }else {
            return response()->json([
                'status_code' => 401,
                'message' => 'Unable to update todo at the moment.'
            ]);
        }
    }

    public function delete($id)
    {
        try
        {
            Todo::findOrFail($id)->delete();
            return response()->json([
                'status_code' => 200,
                'message' => 'Todo deleted successfully'
            ]);
        }

        catch (ModelNotFoundException $e)
        {
            return response()->json([
                'status_code' => 400,
                'message' => 'Unable to delete todo at the moment'
            ]);
        }
    }
}
