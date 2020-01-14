<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function show(Request $request, Tag $tag)
    {
        $articles = $tag
            ->articles()
            ->filter($request)
            ->with(['category', 'tags'])
            ->paginate(5);

        $categories = Category::all();

        return view('tags.show', compact('tag', 'articles', 'categories'));
    }
}
