<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TodoController extends Controller
{
    public function index(Request $request)
    {
        $todos = Todo::where('user_id', $request->user()->id)
            ->orderByDesc('created_at')
            ->get();
        return Inertia::render('Todos/Index', ['todos' => $todos]);
    }

    public function store(Request $request)
    {
        $request->validate(['title' => 'required']);
        $request->user()->todos()->create(['title' => $request->title]);

        return to_route('todos.index');
    }

    public function update(Request $request, Todo $todo)
    {
        $request->validate(['completed' => 'boolean']);
        $todo->update(['completed' => $request->completed]);

        return redirect()->back();
    }

    public function destroy(Todo $todo)
    {
        $todo->delete();

        return redirect()->back();
    }
}
