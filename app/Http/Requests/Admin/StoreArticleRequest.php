<?php

namespace App\Http\Requests\Admin;

use App\Rules\SlugRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreArticleRequest extends FormRequest
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
            'title' => 'required',
            'slug' => ['required', 'string', 'min:5', 'unique:articles,slug', new SlugRule()],
            'summary' => 'required',
            'content' => 'required',
            'category_id' => 'required|exists:categories,id',
            'tags' => 'array',
        ];
    }
}
