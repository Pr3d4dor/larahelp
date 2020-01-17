<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCategoryRequest;
use App\Http\Requests\Admin\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\JsonResponse;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        $category = new Category();

        return view('admin.categories.create', compact('category'));
    }

    public function store(StoreCategoryRequest $request)
    {
        $category = new Category($request->validated());

        $category->save();

        return redirect(route('admin.categories.index'))->with(['alert-success' => 'Categoria criada com sucesso!']);
    }

    public function show(Category $category)
    {
        return view('admin.categories.show', compact('category'));
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $category->update($request->validated());

        return redirect(route('admin.categories.index'))->with(['alert-success' => 'Categoria editada com sucesso!']);
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return JsonResponse::create($category->toArray());
    }
}
