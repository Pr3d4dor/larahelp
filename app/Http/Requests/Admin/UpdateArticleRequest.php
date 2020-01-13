<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateArticleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|min:5',
            'slug' => 'required|string|min:5|unique:articles,slug,' . $this->route('article')->getKey(),
            'summary' => 'required',
            'content' => 'required',
            'category_id' => 'required|exists:categories,id',
            'tags' => 'array',
        ];
    }
}
