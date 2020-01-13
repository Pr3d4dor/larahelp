<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreFaqQuestionRequest;
use App\Http\Requests\Admin\UpdateFaqQuestionRequest;
use App\Models\FaqCategory;
use App\Models\FaqQuestion;
use Illuminate\Http\JsonResponse;

class FaqQuestionController extends Controller
{
    public function index()
    {
        $faqQuestions = FaqQuestion::with(['faqCategory'])->get();

        return view('admin.faq_questions.index', compact('faqQuestions'));
    }

    public function create()
    {
        $faqQuestion = new FaqQuestion();

        $faqCategories = FaqCategory::all();

        return view('admin.faq_questions.create', compact('faqQuestion', 'faqCategories'));
    }

    public function store(StoreFaqQuestionRequest $request)
    {
        $faqQuestion = new FaqQuestion($request->validated());

        $faqQuestion->save();

        return redirect(route('admin.faq_questions.index'))->with(['alert-success' => 'Pergunta frequente criada com sucesso!']);
    }

    public function show(FaqQuestion $faqQuestion)
    {
        //
    }

    public function edit(FaqQuestion $faqQuestion)
    {
        $faqCategories = FaqCategory::all();

        return view('admin.faq_questions.edit', compact('faqQuestion', 'faqCategories'));
    }

    public function update(UpdateFaqQuestionRequest $request, FaqQuestion $faqQuestion)
    {
        $faqQuestion->update($request->validated());

        return redirect(route('admin.faq_questions.index'))->with(['alert-success' => 'Pergunta frequente atualizada com sucesso!']);
    }

    public function destroy(FaqQuestion $faqQuestion)
    {
        $faqQuestion->delete();

        return JsonResponse::create($faqQuestion->toArray());
    }
}
