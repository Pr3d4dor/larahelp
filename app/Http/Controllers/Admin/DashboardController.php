<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $articleCount = Article::count();

        $categoryCount = Category::count();

        $tagCount = Tag::count();

        $popularArticles = Article::orderBy('view_count', 'DESC')->limit(6)->get();

        $popularTags = Tag::select([
            'tags.*',
            'articles.view_count',
            DB::raw('SUM(articles.view_count) as total')
        ])
            ->join('article_tag', 'article_tag.tag_id', '=', 'tags.id')
            ->join('articles', 'article_tag.article_id', '=', 'articles.id')
            ->groupBy('tags.id')
            ->orderBy('total', 'DESC')
            ->limit(10)
            ->get();

        $popularCategories = Category::select([
            'categories.*',
            'articles.view_count',
            DB::raw('SUM(articles.view_count) as total')
        ])->join('articles', 'categories.id', '=', 'articles.category_id')
            ->groupBy('categories.id')
            ->orderBy('total', 'DESC')
            ->limit(10)
            ->get();

        $latestArticles = Article::orderBy('id', 'DESC')->limit(10)->get();

        return view('admin.dashboard', compact(
            'articleCount',
            'categoryCount',
            'tagCount',
            'popularArticles',
            'popularTags',
            'popularCategories',
            'latestArticles'
        ));
    }
}
