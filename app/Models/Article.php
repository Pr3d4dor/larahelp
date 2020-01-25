<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class Article extends Model
{
    public $table = 'articles';

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'title',
        'slug',
        'content',
        'summary',
        'view_count',
        'category_id',
        'created_at',
        'updated_at',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function scopeFilter(Builder $query, Request $request)
    {
        if ($request->has('search') && !is_null($request->get('search'))) {
            $query->where(function (Builder $query) use ($request) {
                $query->where('summary', 'LIKE', '%' . $request->get('search') . '%')
                    ->orWhere('content', 'LIKE', '%' . $request->get('search') . '%')
                    ->orWhere('title', 'LIKE', '%' . $request->get('search') . '%');
            });
        }

        if ($request->has('category_id') && !is_null($request->get('category_id'))) {
            $query->where('category_id', $request->get('category_id'));
        }

        if ($request->has('tags') && !is_null($request->get('tags'))) {
            $query->whereHas('tags', function ($q) use ($request) {
                return $q->whereIn('id', $request->get('tags'));
            });
        }

        return $query;
    }
}
