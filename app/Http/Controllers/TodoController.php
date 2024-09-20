<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function index(): RedirectResponse
    {
        return redirect()->route('category.show', 'inbox');
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
