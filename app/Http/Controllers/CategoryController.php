<?php

namespace App\Http\Controllers;

use App\Models\Category;
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
}
