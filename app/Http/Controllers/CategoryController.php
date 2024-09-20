<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class CategoryController extends Controller
{
    public function show(Category $category): Response
    {
        return Inertia::render('Category/Index', [
            'category' => $category,
            'todos' => $category->todos()->orderByDesc('created_at')->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate(['name' => 'required']);
        $request->user()->categories()->create($validated);

        return redirect()->back();
    }
}
