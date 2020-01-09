<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreTagRequest;
use App\Http\Requests\Admin\UpdateTagRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\Tag;

class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::all();

        return view('admin.tags.index', compact('tags'));
    }

    public function create()
    {
        $tag = new Tag();

        return view('admin.tags.create', compact('tag'));
    }

    public function store(StoreTagRequest $request)
    {
        $tag = new Tag($request->validated());

        $tag->save();

        return redirect(route('admin.tags.index'))->with(['alert-success' => 'Tag criada com sucesso!']);
    }

    public function show($id)
    {
        //
    }

    public function edit(Tag $tag)
    {
        return view('admin.tags.edit', compact('tag'));
    }

    public function update(UpdateTagRequest $request, Tag $tag)
    {
        $tag->update($request->validated());

        return redirect(route('admin.tags.index'))->with(['alert-success' => 'Tag editada com sucesso!']);
    }

    public function destroy(Tag $tag)
    {
        $tag->delete();

        return JsonResponse::create($tag->toArray());
    }
}
