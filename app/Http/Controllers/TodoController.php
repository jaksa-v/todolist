<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class TodoController extends Controller
{
    public function index(Request $request): Response
    {
        $todos = Todo::where('user_id', $request->user()->id)
            ->orderByDesc('created_at')
            ->get();

        return Inertia::render('Todos/Index', ['todos' => $todos]);
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate(['title' => 'required']);
        $request->user()->todos()->create(['title' => $request->title]);

        return to_route('category.show', 'inbox');
    }

    public function update(Request $request, Todo $todo): RedirectResponse
    {
        if ($request->has('title')) {
            $request->validate(['title' => 'required']);
            $todo->update(['title' => $request->title]);
        }

        if ($request->has('completed')) {
            $request->validate(['completed' => 'boolean']);
            $todo->update(['completed' => $request->completed]);
        }

        return redirect()->back();
    }

    public function destroy(Todo $todo): RedirectResponse
    {
        $todo->delete();

        return redirect()->back();
    }
}
