<div class="col-lg-4">
    <div class="card p-3 border-0 shadow">
        <div class="card-header pb-0">
            <h4 class="h5 mb-3">Artigos Populares</h4>
        </div>
        <div class="card-body">
            <ul class="list-line mb-0">
                @foreach($popularArticles as $article)
                    <li class="mb-3"><a class="link-muted" href="{{ route('articles.show', $article->slug) }}">{{ $article->title }}</a></li>
                @endforeach
            </ul>
        </div>
    </div>

    <div class="card p-3 border-0 shadow mt-4">
        <div class="card-header pb-0">
            <h4 class="h5 mb-3">Últimos Artigos</h4>
        </div>
        <div class="card-body">
            <ul class="list-line mb-0">
                @foreach($latestArticles as $article)
                    <li class="mb-3"><a class="link-muted" href="{{ route('articles.show', $article->slug) }}">{{ $article->title }}</a></li>
                @endforeach
            </ul>
        </div>
    </div>

    <div class="card p-3 border-0 shadow mt-4">
        <div class="card-header pb-0">
            <h4 class="h5 mb-3">Tags Populares</h4>
        </div>
        <div class="card-body">
            @foreach($popularTags as $tag)
                <a href="{{ route('tags.show', $tag->slug) }}">
                    <span class="badge badge-secondary">{{ $tag->name }}</span>
                </a>
            @endforeach
        </div>
    </div>
</div>
