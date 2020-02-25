<header class="duik-header">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary position-absolute left-0 right-0 flex-nowrap z-index-3">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home.index') }}">LaraHelp</a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo" aria-controls="navbarTogglerDemo" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarTogglerDemo">
                <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                    <li class="nav-item ml-lg-6 mb-2 mb-lg-0">
                        <a class="nav-link px-0" href="{{ route('home.index') }}">Home</a>
                    </li>
                    <li class="nav-item ml-lg-6 mb-2 mb-lg-0">
                        <a class="nav-link px-0" href="{{ route('articles.index') }}">Artigos</a>
                    </li>
                    <li class="nav-item ml-lg-6 mb-2 mb-lg-0">
                        <a class="nav-link px-0" href="{{ route('categories.index') }}">Categorias</a>
                    </li>
                    <li class="nav-item ml-lg-6 mb-2 mb-lg-0">
                        <a class="nav-link px-0" href="{{ route('tags.index') }}">Tags</a>
                    </li>
                    <li class="nav-item ml-lg-6 mb-2 mb-lg-0">
                        <a class="nav-link px-0" href="{{ route('faq_categories.index') }}">Perguntas Frequentes (FAQ)</a>
                    </li>
                    <li class="nav-item ml-lg-6 mb-2 mb-lg-0">
                        <a class="nav-link px-0" href="{{ route('login') }}">Admin</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- End Navbar -->
</header>
