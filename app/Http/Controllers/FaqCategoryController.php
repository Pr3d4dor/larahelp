<?php

namespace App\Http\Controllers;

use App\Models\FaqCategory;

class FaqCategoryController extends Controller
{
    public function index()
    {
        $faqCategories = FaqCategory::has('faqQuestions', '>=', 1)
            ->withCount('faqQuestions')
            ->with('faqQuestions')
            ->get();

        return view('faq_categories.index', compact('faqCategories'));
    }
}
