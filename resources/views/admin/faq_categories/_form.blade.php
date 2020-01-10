<div>
    <form role="form" action="{{ $faqCategory->exists
        ? route('admin.faq_categories.update', ['faq_category' => $faqCategory->getKey()])
        : route('admin.faq_categories.store') }}"
        method="POST"
    >
        @method($faqCategory->exists ? 'PUT' : 'POST')
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="name">Nome</label>
                <div class="input-group">
                    <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" id="name" name="name" placeholder="Categoria Exemplo" value="{{ $faqCategory->name ?? old('name') }}" autofocus oninput="updateSlug()">
                    @if ($errors->has('name'))
                        <div class="invalid-feedback">
                            {{ $errors->first('name') }}
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
