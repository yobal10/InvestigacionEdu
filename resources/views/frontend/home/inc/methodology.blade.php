<section class="methodology-home">
    <div class="container">
        <div class="methodology-home-card">
            <img src="{{ asset('assets/metodologia-investigacion-total.png') }}" alt="Portada de Metodología de la investigación total, sexta edición">
            <div>
                <span class="methodology-eyebrow">Metodología para tu investigación</span>
                <h2>De la pregunta de investigación a resultados claros</h2>
                <p>Consulta herramientas de cálculo y crea encuestas para recopilar datos en un solo espacio.</p>
                <p class="methodology-author">Referencia: Humberto Ñaupas Paitán y coautores · 6.ª edición</p>
                <a class="btn btn-primary" href="{{ route('frontend.methodology') }}">Explorar fórmulas y recursos</a>
                @auth
                    <a class="btn btn-outline-primary ml-2" href="{{ route('dashboard.surveys.index') }}">Ir a mis encuestas</a>
                @else
                    <a class="btn btn-outline-primary ml-2" href="{{ route('auth.login') }}">Ingresar para crear encuestas</a>
                @endauth
            </div>
        </div>
    </div>
</section>
