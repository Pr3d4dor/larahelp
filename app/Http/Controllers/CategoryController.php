<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show(Request $request, Category $category)
    {
        $articles = $category
            ->articles()
            ->filter($request)
            ->with(['category', 'tags'])
            ->paginate(5);

        $tags = Tag::all();

        return view('categories.show', compact('category', 'articles', 'tags'));
    }
}
