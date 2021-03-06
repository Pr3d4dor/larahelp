@extends('layouts.app')

@section('title', 'LaraHelp - Base de Conhecimento - FAQ')

@section('promo')
    <section class="duik-promo bg-primary">
        <div class="container duik-promo-container">
            <div class="d-flex mh-25rem pt-11 py-6">
                <div class="align-self-center">
                    <h1 class="text-white font-weight-light mb-3">Perguntas Frequentes (FAQ)</h1>

                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb breadcrumb-light">
                            <li class="breadcrumb-item"><a href="{{ route('home.index') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">FAQ</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        @include('partials.background')
    </section>
@endsection

@section('content')
    <div class="container pt-11 pb-8">
        <div class="row">
            <div class="col-lg-4 mb-4 mb-lg-3 order-lg-2">
                <div class="js-sticky-sidebar">
                    <div class="list-group mb-4" id="faq" role="tablist">
                        @foreach($faqCategories as $faqCategory)
                            <a class="list-group-item list-group-item-action {{ $loop->first ? 'active' : '' }}" data-toggle="tab" href="#faq-{{ $faqCategory->getKey() }}" role="tab" aria-controls="faq-{{ $faqCategory->getKey() }}" aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                                {{ $faqCategory->name }} ({{ $faqCategory->faq_questions_count }})
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="col-lg-8 pr-lg-6 order-lg-1">
                <div class="tab-content" id="faqTabContent">
                    @foreach($faqCategories as $faqCategory)
                        <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="faq-{{ $faqCategory->getKey() }}" role="tabpanel" aria-labelledby="faq-{{ $faqCategory->getKey() }}">
                            <div class="accordion" id="accordionExample-{{ $faqCategory->getKey() }}">
                                @foreach($faqCategory->faqQuestions as $faqQuestion)
                                    <div class="card border-bottom mb-3">
                                        <div class="card-header accordion-header d-flex align-items-center" id="headingOne-{{ $faqQuestion->getKey() }}" data-toggle="collapse" data-target="#collapseOne-{{ $faqQuestion->getKey() }}" aria-expanded="{{ $loop->first ? 'true' : 'false' }}" aria-controls="collapseOne-{{ $faqQuestion->getKey() }}" role="region">
                                            <h6 class="mb-0">{{ $faqQuestion->content }}</h6>
                                            <i class="fas fa-angle-down accordion-control ml-auto text-primary"></i>
                                        </div>

                                        <div id="collapseOne-{{ $faqQuestion->getKey() }}" class="collapse {{ $loop->first ? 'show' : '' }}" aria-labelledby="headingOne-{{ $faqQuestion->getKey() }}" data-parent="#accordionExample-{{ $faqCategory->getKey() }}">
                                            <div class="card-body">{{ $faqQuestion->answer }}</div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
