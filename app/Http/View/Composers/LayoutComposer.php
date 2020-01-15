<?php

namespace App\Http\View\Composers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class LayoutComposer
{
    public function compose(View $view)
    {
        $popularArticles = Article::orderBy('view_count', 'DESC')->limit(3)->get();

        $popularTags = Tag::select([
            'tags.*',
            'articles.view_count',
            DB::raw('SUM(articles.view_count) as total')
        ])
            ->join('article_tag', 'article_tag.tag_id', '=', 'tags.id')
            ->join('articles', 'article_tag.article_id', '=', 'articles.id')
            ->groupBy('tags.id')
            ->orderBy('total', 'DESC')
            ->limit(3)
            ->get();

        $popularCategories = Category::select([
            'categories.*',
            'articles.view_count',
            DB::raw('SUM(articles.view_count) as total')
        ])->join('articles', 'categories.id', '=', 'articles.category_id')
            ->groupBy('categories.id')
            ->orderBy('total', 'DESC')
            ->limit(3)
            ->get();

        $latestArticles = Article::orderBy('id', 'DESC')->limit(3)->get();

        $view->with('popularArticles', $popularArticles);
        $view->with('popularTags', $popularTags);
        $view->with('popularCategories', $popularCategories);
        $view->with('latestArticles', $latestArticles);
    }
}
