<?php

namespace App\Http\Controllers;

use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationData;
use App\Models\Todo;
use Symfony\Component\Console\Logger\ConsoleLogger;

class TodoController extends Controller
{
    public function index()
    {
        $todo = Todo::all();
        // get all data in todos table
        // interact via model Todo
        return view('index')->with('todos', $todo);
    }

    public function create()
    {
        // return view('todos.create');
        return view('create');
    }

    public function details(Todo $todo)
    {
        return view('details')->with('todos', $todo);
    }

    public function edit(Todo $todo)
    {
        return view('edit')->with('todos', $todo);
    }

    public function update(Todo $todo)
    {
        try {
            $this->validate(request(), [
                'name' => ['required'],
                'description' => ['required']
            ]);
        } catch (ValidationException $e) {
        }

        $data = request()->all();

        $todo->name = $data['name'];
        $todo->description = $data['description'];
        $todo->save();

        session()->flash('success', 'Todo updated successfully');

        return redirect('/');
    }

    public function delete(Todo $todo)
    {
        $todo->delete();
        return redirect('/');
    }

    public function store()
    {
        // validate data by marking fields as required
        try {
            $this->validate(request(), [
                'name' => ['required'],
                'description' => ['required']
            ]);
        } catch (ValidationException $e) {
        }

        // get all the request coming in
        $data = request()->all();

        // store data in an object
        // on left is field name in db
        // on the right is field name in form/view
        $todo = new Todo();
        $todo->name = $data['name'];
        $todo->description = $data['description'];
        $todo->save(); // save in database

        // display success message
        session()->flash('success', 'Todo created successfully');

        // return to homepage
        return redirect('/');
    }
}
