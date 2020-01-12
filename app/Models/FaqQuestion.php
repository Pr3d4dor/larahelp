<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FaqQuestion extends Model
{
    public $table = 'faq_questions';

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'content',
        'answer',
        'faq_category_id',
    ];

    public function faqCategory()
    {
        return $this->belongsTo(FaqCategory::class);
    }
}
