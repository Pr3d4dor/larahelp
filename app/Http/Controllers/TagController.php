<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::select([
            'tags.*',
            'articles.view_count',
            DB::raw('SUM(articles.view_count) as total')
        ])
            ->leftJoin('article_tag', 'article_tag.tag_id', '=', 'tags.id')
            ->leftJoin('articles', 'article_tag.article_id', '=', 'articles.id')
            ->withCount('articles')
            ->groupBy('tags.id')
            ->orderBy('total', 'DESC')
            ->paginate(10);

        return view('tags.index', compact('tags'));
    }

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
