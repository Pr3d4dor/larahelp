<div class="card mb-4">
    <div class="card-header">
        <h3>{{ $article->title }}</h3>
    </div>
    <div class="card-body">
        <div class="mb-4">
            <span>
                <i class="fa fa-folder mr-1"></i><strong>Categoria:</strong>
                <a href="{{ route('categories.show', $article->category->slug) }}">
                    {{ $article->category->name }}
                </a>
            </span>
        </div>

        {!! $article->summary !!}

        <div class="mt-4">
            <span>
                <i class="fa fa-edit mr-1"></i><strong>Postado em:</strong> @formatDate($article->created_at)
            </span>
            <span class="float-right">
                <i class="fa fa-edit mr-1"></i><strong>Última atualização:</strong> @formatDate($article->updated_at)
            </span>
        </div>
    </div>
    <div class="card-footer">
        <div class="float-left">
            <i class="fa fa-tags mr-1"></i><span>Tags: </span>
            @forelse($article->tags as $tag)
                <a href="{{ route('tags.show', $tag->slug) }}" class="a-no-border">
                    <span class="badge badge-secondary">{{ $tag->name }}</span>
                </a>
            @empty
                <span>Nenhuma.</span>
            @endforelse
        </div>
        <div class="float-right">
            <a href="{{ route('articles.show', $article->slug) }}">
                Ler Mais
            </a>
        </div>
    </div>
</div>
