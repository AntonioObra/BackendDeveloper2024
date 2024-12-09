<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;
use Illuminate\Support\Facades\Auth;

class TodoController extends Controller
{
    public function view()
    {
        // * Dobi sve todos od korisnika
        $user = auth()->user();
        $todos = $user->todos;

        return view("todos.index", [
            "todos" => $todos,
        ]);
    }

    public function show_create()
    {
        return view("todos.create");
    }

    public function create_todo(Request $request)
    {
        $validated_data = $request->validate([
            "title" => "required|string|max:255",
            "description" => "required|string|max:512",
        ]);

        $todo = Auth::user()->todos()->create($validated_data);

        return redirect()
            ->route("todos")
            ->with("success", "Todo created successfully!");
    }

    public function show_edit($todo_id)
    {
        $todo_to_edit = Todo::findOrFail($todo_id);

        return view("todos.edit", [
            "todo" => $todo_to_edit,
        ]);
    }

    public function edit_todo(Request $request, $todo_id)
    {
        $validatedData = $request->validate([
            "title" => "required|string|max:255",
            "description" => "nullable|string",
        ]);

        $todo = Todo::findOrFail($todo_id);
        $todo->update($validatedData);

        return redirect()
            ->route("todos")
            ->with("success", "Todo updated successfully!");
    }

    public function set_todo_as_done($todo_id)
    {
        $todo = Todo::findOrFail($todo_id);
        $todo->update(["is_done" => true]);

        return redirect()
            ->route("todos")
            ->with("success", "Todo marked as done!");
    }

    public function delete($todo_id)
    {
        $todo = Todo::findOrFail($todo_id);
        $todo->delete();

        return redirect()
            ->route("todos")
            ->with("success", "Todo deleted successfully!");
    }
}
