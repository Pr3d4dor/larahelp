<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('articles')
            ->with(['articles' => function ($query) {
                $query->orderBy('id', 'desc');
            }])
            ->orderBy('articles_count', 'DESC')
            ->limit(6)
            ->get(['name']);

        $articles = Article::orderBy('view_count', 'DESC')->limit(4)->get(['title', 'created_at']);

        $popularCategories = Category::with(['articles' => function ($query) {
            $query->orderBy('view_count', 'desc');
        }])
        ->limit(3)
        ->get(['name']);

        return view('index', compact('categories', 'articles', 'popularCategories'));
    }
}
