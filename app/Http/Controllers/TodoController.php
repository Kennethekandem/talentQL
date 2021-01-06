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

        // validate request
        $request->validate([
            'title' => 'required|max:100',
            'description' => 'required'
        ]);

        // create a new column in todo table with the request data
        $create = Todo::create(array(
            'title' => $request['title'],
            'description' => $request['description'],
            'completed' => 0
        ));

        // return response
        if($create) {
            return response()->json([
                'status_code' => 200,
                'message' => 'Todo created successfully',
                'data' => $create
            ]);
        }
    }

    public function update(Request $request, $id) {

        // find todo with id and update
        $update = Todo::findOrFail($id)->update($request->all());

        if($update) {

            // find todo and get data
            $todo = Todo::find($id);

            // return response
            return response()->json([
                'status_code' => 200,
                'message' => 'Todo updated successfully',
                'data' => $todo
            ]);
        }else {
            // return error if the request did not go through
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
            // find and delete todo by id
            Todo::findOrFail($id)->delete();
            return response()->json([
                'status_code' => 200,
                'message' => 'Todo deleted successfully'
            ]);
        }

        catch (ModelNotFoundException $e)
        {
            // throw error if id does not exist in todos table
            return response()->json([
                'status_code' => 400,
                'message' => 'Unable to delete todo at the moment'
            ]);
        }
    }
}
