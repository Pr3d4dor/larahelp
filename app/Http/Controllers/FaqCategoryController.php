<?php

namespace App\Http\Controllers;

use App\Models\FaqCategory;
use App\Models\FaqQuestion;
use Illuminate\Http\Request;

class FaqCategoryController extends Controller
{
    public function index()
    {
        $faqCategories = FaqCategory::withCount('faqQuestions')
            ->with('faqQuestions')
            ->where('faq_questions_count', '>', 0)
            ->orderBy('id')
            ->get();

        return view('faq_categories.index', compact('faqCategories'));
    }
}
