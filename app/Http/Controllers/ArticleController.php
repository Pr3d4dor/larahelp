<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {

    }

    public function show(Article $article)
    {
        return view('articles.show', compact('article'));
    }
}
