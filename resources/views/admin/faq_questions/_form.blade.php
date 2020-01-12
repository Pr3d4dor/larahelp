<div>
    <form role="form" action="{{ $faqQuestion->exists
        ? route('admin.faq_questions.update', ['faq_question' => $faqQuestion->getKey()])
        : route('admin.faq_questions.store') }}"
        method="POST"
        id="form"
    >
        @method($faqQuestion->exists ? 'PUT' : 'POST')
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="content">Pergunta</label>
                <div class="input-group">
                    <textarea class="form-control {{ $errors->has('content') ? 'is-invalid' : '' }}" id="content" name="content" rows="5" form="form">{{ $faqQuestion->content ? $faqQuestion->content : old('content') }}</textarea>
                    @if ($errors->has('content'))
                        <div class="invalid-feedback">
                            {{ $errors->first('content') }}
                        </div>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <label for="answer">Resposta</label>
                <div class="input-group">
                    <textarea class="form-control {{ $errors->has('content') ? 'is-invalid' : '' }}" id="answer" name="answer" rows="5" form="form">{{ $faqQuestion->content ? $faqQuestion->content : old('answer') }}</textarea>
                    @if ($errors->has('answer'))
                        <div class="invalid-feedback">
                            {{ $errors->first('answer') }}
                        </div>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <label for="faq_category_id">Categoria</label>
                <div class="input-group">
                    <select class="form-control select2 {{ $errors->has('faq_category') ? 'is-invalid' : '' }}" name="faq_category_id" id="faq_category_id">
                        <option value=""></option>
                        @foreach($faqCategories as $faqCategory)
                            <option value="{{ $faqCategory->getKey() }}" {{ ($faqQuestion->faqCategory && $faqQuestion->faqCategory->getKey() === $faqCategory->getKey()) ? 'selected' : '' }}>{{ $faqCategory->name }}</option>
                        @endforeach
                    </select>

                    @if ($errors->has('faq_category'))
                        <div class="invalid-feedback">
                            {{ $errors->first('faq_category') }}
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
