<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreArticleRequest;
use App\Http\Requests\Admin\UpdateArticleRequest;
use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\JsonResponse;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::with(['category', 'tags'])->get();

        return view('admin.articles.index', compact('articles'));
    }

    public function create()
    {
        $article = new Article();

        $categories = Category::all();

        $tags = Tag::all();

        return view('admin.articles.create', compact('article', 'categories', 'tags'));
    }

    public function store(StoreArticleRequest $request)
    {
        $data = $request->validated();

        $article = new Article($data);

        $article->save();

        if (isset($data['tags'])) {
            $article->tags()->sync($data['tags']);
        }

        return redirect(route('admin.articles.index'))->with(['alert-success' => 'Artigo criado com sucesso!']);
    }

    public function show(Article $article)
    {
        $article->load(['category', 'tags']);

        return view('admin.articles.show', compact('article'));
    }

    public function edit(Article $article)
    {
        $article->load(['category', 'tags']);

        $categories = Category::all();

        $tags = Tag::all();

        return view('admin.articles.edit', compact('article', 'categories', 'tags'));
    }

    public function update(UpdateArticleRequest $request, Article $article)
    {
        $data = $request->validated();

        $article->update($request->validated());

        if (isset($data['tags'])) {
            $article->tags()->sync($data['tags']);
        }

        return redirect(route('admin.articles.index'))->with(['alert-success' => 'Artigo atualizado com sucesso!']);
    }

    public function destroy(Article $article)
    {
        $article->delete();

        return JsonResponse::create($article->toArray());
    }
}
