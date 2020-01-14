<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('articles')
            ->orderBy('articles_count', 'DESC')
            ->limit(6)
            ->get(['name']);

        return view('index', compact('categories'));
    }
}
