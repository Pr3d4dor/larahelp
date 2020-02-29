<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::select([
                'categories.*',
                'articles.view_count',
                DB::raw('SUM(articles.view_count) as total')
            ])
            ->leftJoin('articles', 'categories.id', '=', 'articles.category_id')
            ->withCount('articles')
            ->groupBy('categories.id')
            ->orderBy('total', 'DESC')
            ->paginate(10);

        return view('categories.index', compact('categories'));
    }

    public function show(Request $request, Category $category)
    {
        $category->handleSEOHeaders();

        $articles = $category
            ->articles()
            ->filter($request)
            ->with(['category', 'tags'])
            ->paginate(5);

        $tags = Tag::all();

        return view('categories.show', compact('category', 'articles', 'tags'));
    }
}
