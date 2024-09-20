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
        $validated = $request->validate(['title' => 'required', 'category_id' => 'integer|exists:categories,id']);
        $request->user()->todos()->create($validated);

        return redirect()->back();
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
