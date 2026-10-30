@extends('frontend.public-site.master')

@php
    $isArticle = isset($article);
@endphp
@section('title', $isArticle ? $article['title'].' | InvestigacionEdu' : 'InvestigacionEdu | '.ucfirst($pageKey))
@section('meta_description', $isArticle ? $article['excerpt'] : 'Recursos y guías para planificar estudios, crear cuestionarios y analizar información con rigor.')

@section('content')
@if($isArticle)
    @php
        $showBookCover = $article['slug'] === 'metodologia-de-estudios-online';
    @endphp
    <main class="m-container">
        <nav class="m-breadcrumb" aria-label="Ruta de navegación"><a href="{{ route('frontend.home') }}">Inicio</a><span aria-hidden="true">›</span><a href="{{ url('/recursos') }}">Recursos</a><span aria-hidden="true">›</span><span>{{ $article['category'] }}</span></nav>
        <div class="m-layout">
            <article class="m-article">
                <h1>{{ $article['title'] }}</h1>
                <div class="m-alt-hero{{ $showBookCover ? ' m-alt-hero-book' : '' }}">
                    <img src="{{ asset($showBookCover ? 'assets/metodologia-investigacion-total.png' : 'assets/frontend/images/imagen-estudio.svg') }}" alt="{{ $showBookCover ? 'Portada de Metodología de la investigación total, sexta edición' : 'Ilustración de análisis de datos y resultados' }}">
                    @unless($showBookCover)<span>{{ $article['category'] }}</span>@endunless
                </div>
                <div class="m-byline"><span>GUÍA DE INVESTIGACIÓN</span><span aria-hidden="true">·</span><time>{{ $article['date'] }}</time><span aria-hidden="true">·</span><span>Lectura educativa</span></div>
                <div class="m-prose">
                    <p class="m-lead">{{ $article['excerpt'] }}</p>
                    @foreach($article['sections'] as $section)
                        <section><h2>{{ $section['heading'] }}</h2>@foreach($section['paragraphs'] as $paragraph)<p>{{ $paragraph }}</p>@endforeach</section>
                    @endforeach
                    <div class="m-ending"><h2>Continúa con la guía metodológica</h2><p>Consulta una ruta educativa más amplia para plantear y organizar un estudio.</p><a class="m-modal-primary" href="{{ route('frontend.research.guide') }}">LEER LA GUÍA →</a></div>
                </div>
                <section class="m-more"><h2>Otros artículos que podrían interesarte</h2><div class="m-more-grid">
                    @foreach($relatedArticles as $relatedArticle)
                        <a href="{{ url('/blog/'.$relatedArticle['slug']) }}"><img src="{{ asset('assets/frontend/images/imagen-estudio.svg') }}" alt=""><b>{{ $relatedArticle['title'] }}</b><small>{{ $relatedArticle['date'] }}</small></a>
                    @endforeach
                </div></section>
            </article>
            <aside class="m-right" aria-label="Recursos relacionados">
                <section class="m-promo"><span class="m-promo-dots" aria-hidden="true"></span><h2>Investiga con objetivos y preguntas claros</h2><p>Revisa recursos metodológicos antes de diseñar tu instrumento.</p><a class="m-promo-link" href="{{ route('frontend.research.guide') }}">ABRIR GUÍA METODOLÓGICA</a><span class="m-promo-corner" aria-hidden="true"></span></section>
                <section class="m-related"><h2>RELATED ARTICLES</h2>
                    @foreach($relatedArticles as $relatedArticle)
                        <a class="m-related-row" href="{{ url('/blog/'.$relatedArticle['slug']) }}"><div class="m-related-image"><img src="{{ asset('assets/frontend/images/imagen-estudio.svg') }}" alt=""></div><div><b>{{ $relatedArticle['title'] }}</b><small>{{ $relatedArticle['date'] }}</small></div></a>
                    @endforeach
                </section>
                <section class="m-topic-box"><h2>EXPLORA MÁS RECURSOS</h2><a href="{{ url('/recursos') }}">Artículos y guías <span>›</span></a><a href="{{ url('/plantillas') }}">Plantillas <span>›</span></a><a href="{{ route('frontend.research.guide') }}">Guía metodológica <span>›</span></a></section>
            </aside>
        </div>
    </main>
@else
    @php
        $pageContent = [
            'inicio' => ['title' => 'Investiga, pregunta y comprende tus resultados', 'description' => 'Recursos para planificar estudios, construir instrumentos claros y comunicar hallazgos con responsabilidad.', 'kicker' => 'NEXO SURVEYS · RECURSOS DE INVESTIGACIÓN'],
            'recursos' => ['title' => 'Guías para investigar con más claridad', 'description' => 'Artículos metodológicos y publicaciones del sitio para orientar las distintas etapas de un estudio.', 'kicker' => 'BIBLIOTECA DE RECURSOS'],
            'caracteristicas' => ['title' => 'Herramientas para cada etapa de tu estudio', 'description' => 'Un recorrido por prácticas útiles para diseñar preguntas, recopilar información y revisar resultados.', 'kicker' => 'CARACTERÍSTICAS'],
            'soluciones' => ['title' => 'Métodos adecuados para preguntas distintas', 'description' => 'Orienta estudios académicos, evaluaciones y proyectos de investigación según su objetivo y contexto.', 'kicker' => 'SOLUCIONES'],
            'plantillas' => ['title' => 'Punto de partida para tus instrumentos', 'description' => 'Consulta guías y ejemplos antes de adaptar preguntas a tu población, objetivo y diseño metodológico.', 'kicker' => 'PLANTILLAS Y GUÍAS'],
            'precios' => ['title' => 'Acceso público a guías y artículos', 'description' => 'El proyecto no tiene pagos ni planes comerciales configurados. Los recursos públicos están disponibles para consulta.', 'kicker' => 'ACCESO'],
        ];
        $content = $pageContent[$pageKey] ?? $pageContent['recursos'];
    @endphp
    <main class="m-container m-landing">
        <nav class="m-breadcrumb" aria-label="Ruta de navegación"><a href="{{ route('frontend.home') }}">Inicio</a><span aria-hidden="true">›</span><span>{{ $content['kicker'] }}</span></nav>
        <section class="m-landing-hero"><span class="m-kicker">{{ $content['kicker'] }}</span><h1>{{ $content['title'] }}</h1><p>{{ $content['description'] }}</p><div><a href="{{ url('/recursos') }}">Explorar artículos y guías →</a><a href="{{ route('frontend.research.guide') }}">Guía de metodología →</a></div></section>

        @if($pageKey === 'precios')
            <section class="m-plan"><span>INFORMACIÓN DEL PROYECTO</span><strong>Sin pagos</strong><p>Este Laravel ofrece artículos, autenticación y administración de contenido. No incluye suscripciones ni un constructor de encuestas.</p><a href="{{ route('auth.login') }}">Acceso al panel de administración</a></section>
        @else
            <section class="m-feature-list" aria-label="Áreas de trabajo">
                <article><span aria-hidden="true">▤</span><h2>Diseña preguntas claras</h2><p>Define qué necesitas conocer y evita preguntas ambiguas o sesgadas.</p></article>
                <article><span aria-hidden="true">◉</span><h2>Planifica la recolección</h2><p>Considera participantes, consentimiento y protección de la información.</p></article>
                <article><span aria-hidden="true">▥</span><h2>Interpreta con contexto</h2><p>Relaciona los resultados con el diseño, la muestra y los límites del estudio.</p></article>
            </section>
        @endif

        @if($pageKey === 'recursos' || $pageKey === 'inicio' || $pageKey === 'plantillas')
            <h2 class="m-landing-h2">Artículos y guías</h2>
            <div class="m-article-list">
                @foreach($posts ?? [] as $post)
                    <a href="{{ route('frontend.post', $post->slug) }}"><img src="{{ $post->thumbnail ? asset('uploads/post/'.$post->thumbnail) : asset('assets/frontend/images/imagen-estudio.svg') }}" alt=""><div><small>{{ optional($post->category)->title ?? 'Artículo' }} · {{ optional($post->created_at)->format('d/m/Y') }}</small><h3>{{ $post->title }}</h3><p>{{ \Illuminate\Support\Str::limit(strip_tags($post->content), 130) }}</p><span>Leer artículo →</span></div></a>
                @endforeach
                @foreach($articles as $resource)
                    <a href="{{ url('/blog/'.$resource['slug']) }}"><img src="{{ asset('assets/frontend/images/imagen-estudio.svg') }}" alt=""><div><small>{{ $resource['category'] }} · {{ $resource['date'] }}</small><h3>{{ $resource['title'] }}</h3><p>{{ $resource['excerpt'] }}</p><span>Leer guía →</span></div></a>
                @endforeach
            </div>
        @endif
        <div class="m-site-note">Las páginas informativas y guías son recursos educativos. La creación, publicación y almacenamiento de encuestas no están implementados en este proyecto.</div>
    </main>
@endif
@endsection