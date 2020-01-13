<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FaqCategory extends Model
{
    public $table = 'faq_categories';

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'name',
    ];

    public function faqQuestions()
    {
        return $this->hasMany(FaqQuestion::class, 'faq_category_id', 'id');
    }

    public function scopeActive($query)
    {
        if (request()->query('active')) {
            $query->where('id', request()->query('active'));
        }
    }
}
