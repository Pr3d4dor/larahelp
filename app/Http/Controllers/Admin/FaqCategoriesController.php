<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreFaqCategoryRequest;
use App\Http\Requests\Admin\UpdateFaqCategoryRequest;
use App\Models\FaqCategory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FaqCategoriesController extends Controller
{
    public function index()
    {
        $faqCategories = FaqCategory::all();

        return view('admin.faq_categories.index', compact('faqCategories'));
    }

    public function create()
    {
        $faqCategory = new FaqCategory();

        return view('admin.faq_categories.create', compact('faqCategory'));
    }

    public function store(StoreFaqCategoryRequest $request)
    {
        $faqCategory = new FaqCategory($request->validated());

        $faqCategory->save();

        return redirect(route('admin.faq_categories.index'))->with(['alert-success' => 'Categoria de criada com sucesso!']);
    }

    public function show($id)
    {
        //
    }

    public function edit(FaqCategory $faqCategory)
    {
        return view('admin.faq_categories.edit', compact('faqCategory'));
    }

    public function update(UpdateFaqCategoryRequest $request, FaqCategory $faqCategory)
    {
        $faqCategory->update($request->validated());

        return redirect(route('admin.faq_categories.index'))->with(['alert-success' => 'Categoria editada com sucesso']);
    }

    public function destroy(FaqCategory $faqCategory)
    {
        $faqCategory->delete();

        return JsonResponse::create($faqCategory->toArray());
    }
}
