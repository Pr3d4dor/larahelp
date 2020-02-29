<?php

namespace App\Models;

use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $table = 'categories';

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'name',
        'slug',
    ];

    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    public function handleSEOHeaders()
    {
        SEOMeta::setDescription($this->name);
        SEOMeta::addMeta('article:published_time', $this->created_at->toW3CString(), 'property');
        SEOMeta::addMeta('article:section', $this->name, 'property');

        OpenGraph::setTitle($this->name);
        OpenGraph::setDescription($this->name);
        OpenGraph::addProperty('type', 'article');
        OpenGraph::addProperty('locale', 'pt-br');
        OpenGraph::addProperty('locale:alternate', ['pt-pt', 'en-us']);

        JsonLd::setTitle($this->name);
        JsonLd::setDescription($this->name);
        JsonLd::setType('Article');

        return $this;
    }
}
