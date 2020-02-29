<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $articles = Article::with(['category', 'tags'])->filter($request)->paginate(5);

        $categories = Category::all();

        $tags = Tag::all();

        return view('articles.index', compact('articles', 'categories', 'tags'));
    }

    public function show(Article $article)
    {
        $article->handleSEOHeaders()->increment('view_count');

        return view('articles.show', compact('article'));
    }
}
