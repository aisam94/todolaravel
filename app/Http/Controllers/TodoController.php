<?php

namespace App\Http\Controllers;

use Dotenv\Exception\ValidationException;
use App\Models\Todo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class TodoController extends Controller
{
    public function index()
    {
        // get all data in todos table
        // interact via model Todo
        // $todo = Todo::all();
        if (Auth::check()) {
            $user = Auth::user();
            $todo = Todo::where('user_id', '=', $user->id)->get();
            return view('index')->with('todos', $todo)->with('user', $user);
        }
        // return view('index');
        return redirect('login');
    }

    public function create()
    {
        // return view('todos.create');
        return view('create')->with('user', Auth::user());
    }

    public function details(Todo $todo)
    {
        // both below are the same
        // like inputing props into components
        return view('details', ['todos' => $todo]);
        // return view('details')->with('todos', $todo);
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
        $todo->id = Str::uuid();
        $todo->name = $data['name'];
        $todo->description = $data['description'];

        $user = Auth::user();
        $todo->user_id = $user->id;

        $todo->save(); // save in database

        // display success message
        session()->flash('success', 'Todo created successfully');

        // return to homepage
        return redirect('/');
    }
}
