<div>
    <form role="form" action="{{ $article->exists
        ? route('admin.articles.update', ['article' => $article->getKey()])
        : route('admin.articles.store') }}"
        method="POST"
        id="form"
    >
        @method($article->exists ? 'PUT' : 'POST')
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="title">Título</label>
                <div class="input-group">
                    <input type="text" class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" id="title" name="title" placeholder="Título Exemplo" value="{{ $article->title ?? old('title') }}" autofocus oninput="updateSlug()">
                    @if ($errors->has('title'))
                        <div class="invalid-feedback">
                            {{ $errors->first('title') }}
                        </div>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <label for="slug">Slug</label>
                <div class="input-group">
                    <input type="text" class="form-control {{ $errors->has('slug') ? 'is-invalid' : '' }}" id="slug" name="slug" placeholder="titulo-exemplo" value="{{ $article->slug ?? old('slug') }}">
                    @if ($errors->has('slug'))
                        <div class="invalid-feedback">
                            {{ $errors->first('slug') }}
                        </div>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <label for="summary">Sumário</label>
                <div class="input-group">
                    <textarea class="form-control {{ $errors->has('summary') ? 'is-invalid' : '' }}" id="summary"  name="summary" rows="5" form="form">{{ $article->summary ? $article->summary : old('summary')}}</textarea>
                    @if ($errors->has('summary'))
                        <div class="invalid-feedback">
                            {{ $errors->first('summary') }}
                        </div>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <label for="content">Conteúdo</label>
                <div class="input-group">
                    <textarea class="form-control {{ $errors->has('content') ? 'is-invalid' : '' }}" id="content" name="content" rows="5" form="form">{{ $article->content ? $article->content : old('content') }}</textarea>
                    @if ($errors->has('content'))
                        <div class="invalid-feedback">
                            {{ $errors->first('content') }}
                        </div>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <label for="category_id">Categoria</label>
                <div class="input-group">
                    <select class="form-control select2 {{ $errors->has('category') ? 'is-invalid' : '' }}" name="category_id" id="category_id">
                        <option value=""></option>
                        @foreach($categories as $category)
                            <option value="{{ $category->getKey() }}" {{ ($article->category && $article->category->getKey() === $category->getKey()) ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>

                    @if ($errors->has('category'))
                        <div class="invalid-feedback">
                            {{ $errors->first('category') }}
                        </div>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <label for="tags">Tags</label>
                <div class="input-group">
                    <select class="form-control select2 {{ $errors->has('tags') ? 'is-invalid' : '' }}" name="tags[]" id="tags" multiple>
                        <option value=""></option>
                        @foreach($tags as $tag)
                            <option value="{{ $tag->getKey() }}" {{ in_array($tag->getKey(), $article->tags->pluck('id')->toArray()) ? 'selected' : '' }}>{{ $tag->name }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('tags'))
                        <div class="invalid-feedback">
                            {{ $errors->first('tags') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Salvar</button>
        </div>
    </form>
</div>

@section('css')
    <style>
        textarea {
            resize: vertical;
        }
    </style>
@endsection

@section('js')
    <script>
        function updateSlug() {
            var title = $('#title').val();
            var slug = window.slugify(title);
            $('#slug').val(slug);
        }
    </script>
@endsection
