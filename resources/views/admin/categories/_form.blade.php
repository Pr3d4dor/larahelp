<div>
    <form role="form" action="{{ $category->exists
        ? route('admin.categories.update', ['category' => $category->getKey()])
        : route('admin.categories.store') }}"
        method="POST"
    >
        @method($category->exists ? 'PUT' : 'POST')
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="name">Nome</label>
                <div class="input-group">
                    <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" id="name" name="name" placeholder="Categoria Exemplo" value="{{ $category->name ?? old('name') }}" autofocus oninput="updateSlug()">
                    @if ($errors->has('name'))
                        <div class="invalid-feedback">
                            {{ $errors->first('name') }}
                        </div>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <label for="slug">Slug</label>
                <div class="input-group">
                    <input type="text" class="form-control {{ $errors->has('slug') ? 'is-invalid' : '' }}" id="slug" name="slug" placeholder="categoria-exemplo" value="{{ $category->slug ?? old('slug') }}">
                    @if ($errors->has('slug'))
                        <div class="invalid-feedback">
                            {{ $errors->first('slug') }}
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

@section('js')
    <script>
        function updateSlug() {
            var name = $('#name').val();
            var slug = window.slugify(name);
            $('#slug').val(slug);
        }
    </script>
@endsection
