@extends('frontend.master')

@section('title', 'Guía de metodología de la investigación | InvestigaEdu')
@section('meta_description', 'Guía educativa sobre metodología de investigación: bases científicas, formulación del problema, objetivos, marco teórico, diseño, muestra, análisis, tesis y ética.')

@section('content')
<main class="ie-article-page">
    <div class="ie-article-topband">
        <div class="container">
            <nav class="ie-breadcrumbs" aria-label="Ruta de navegación">
                <a href="{{ route('frontend.home') }}#inicio">Inicio</a><span aria-hidden="true">›</span><a href="{{ route('frontend.home') }}#temas">Biblioteca de metodología</a><span aria-hidden="true">›</span><span>Guía completa</span>
            </nav>
            <div class="ie-article-heading">
                <div>
                    <span class="ie-article-category">GUÍA DE INVESTIGACIÓN · TESIS</span>
                    <h1>Metodología de la investigación: cómo construir un estudio coherente, desde el problema hasta los resultados</h1>
                    <p class="ie-article-deck">Una explicación práctica para organizar las decisiones centrales de tu proyecto académico, con énfasis en los temas metodológicos asociados a Humberto Ñaupas Paitán.</p>
                    <div class="ie-article-byline"><span class="ie-author-avatar">HÑ</span><span><b>Autor de referencia</b><strong>Humberto Ñaupas Paitán</strong></span><span class="ie-byline-divider"></span><span class="ie-byline-meta">Guía educativa original<br>Tiempo estimado: 8–10 min</span></div>
                </div>
                <aside class="ie-article-cover-card" aria-label="Resumen de la guía">
                    <div class="ie-cover-top"><span>INVESTIGAEDU</span><span>01 / 06</span></div>
                    <div class="ie-cover-illustration"><span class="ie-cover-ring ie-cover-ring-a"></span><span class="ie-cover-ring ie-cover-ring-b"></span><span class="ie-cover-equation">?</span><span class="ie-cover-spark ie-cover-spark-a">+</span><span class="ie-cover-spark ie-cover-spark-b">∑</span></div>
                    <div class="ie-cover-bottom"><b>Pregunta</b><span>→</span><b>Método</b><span>→</span><b>Evidencia</b></div>
                </aside>
            </div>
        </div>
    </div>

    <div class="container ie-article-layout">
        <article class="ie-article-content">
            <p class="ie-article-intro">Investigar significa desarrollar un proceso ordenado para responder una pregunta relevante con razones y evidencias. En una tesis, cada decisión debe tener relación con el problema: el objetivo orienta el estudio; el sustento conceptual ayuda a delimitarlo; el diseño organiza la recolección; y el análisis debe permitir responder lo que se planteó.</p>

            <div class="ie-article-callout"><span>Idea central</span><p>Una metodología consistente no se reconoce por acumular técnicas o estadísticas, sino porque justifica por qué cada una es adecuada para la pregunta investigada.</p></div>

            <section id="guia-fundamentos" class="ie-article-section">
                <span class="ie-article-kicker">01 · FUNDAMENTOS</span>
                <h2>¿Qué significa trabajar con rigor científico?</h2>
                <p>El trabajo científico requiere preguntas explícitas, argumentos que puedan examinarse y procedimientos que hagan visible cómo se obtuvo la información. La epistemología ayuda a reflexionar sobre qué se considera conocimiento, cómo se justifica y qué límites tienen las afirmaciones que se presentan.</p>
                <p>La introducción de la sexta edición de <em>Metodología de la investigación total</em> destaca la necesidad de integrar el pensamiento crítico con las decisiones metodológicas y presenta una mirada que articula herramientas cuantitativas y cualitativas. Esto no implica que todos los proyectos deban usar ambos enfoques: la elección depende del problema y del tipo de evidencia que se necesite.</p>
                <div class="ie-article-keyline"><b>Antes de empezar, pregúntate:</b><span>¿Qué fenómeno deseo comprender?</span><span>¿Qué información sería evidencia pertinente?</span><span>¿Qué límites tendrá mi conclusión?</span></div>
            </section>

            <section id="guia-problema" class="ie-article-section">
                <span class="ie-article-kicker">02 · PLANTEAMIENTO</span>
                <h2>Define el problema antes de escoger el método</h2>
                <p>Un problema de investigación delimita qué aspecto de una realidad se estudiará y por qué requiere indagación. Para evitar un tema demasiado amplio, precisa el contexto, la unidad de análisis, el periodo que corresponda y la relación o fenómeno que deseas examinar.</p>
                <h3>Ejemplo de transformación de un tema en problema</h3>
                <div class="ie-example-compare"><div><span>Tema amplio</span><p>Uso de herramientas digitales en estudiantes.</p></div><div><span>Pregunta delimitada</span><p>¿Cómo se relaciona la frecuencia de uso de una plataforma virtual con la participación académica de los estudiantes de un programa durante un semestre?</p></div></div>
                <p>El ejemplo es ilustrativo: antes de adoptarlo se deben revisar antecedentes, disponibilidad de datos, pertinencia, acceso a participantes y normas de la institución.</p>
                <h3>Formula objetivos verificables</h3>
                <p>El objetivo general expresa el propósito central. Los objetivos específicos dividen ese propósito en logros concretos y relacionados entre sí. Usa verbos precisos y comprueba que las técnicas previstas permitan obtener la información necesaria para cumplirlos.</p>
            </section>

            <section id="guia-marco" class="ie-article-section">
                <span class="ie-article-kicker">03 · MARCO TEÓRICO</span>
                <h2>Organiza antecedentes, conceptos, hipótesis y variables</h2>
                <p>El marco teórico no consiste en acumular definiciones. Su función es organizar lo que ya se conoce, mostrar qué debates existen y construir una base conceptual para interpretar el problema. Las fuentes deben seleccionarse por su pertinencia y calidad, y citarse de modo que otra persona pueda localizarlas.</p>
                <p>Cuando el planteamiento y el enfoque lo requieren, las hipótesis expresan proposiciones que se examinarán con evidencia. Las variables describen características que pueden adquirir distintos valores; en otros estudios puede ser más apropiado trabajar con categorías, experiencias o significados. No todos los diseños cualitativos necesitan formular hipótesis estadísticas.</p>
                <div class="ie-article-callout ie-article-callout-soft"><span>Comprobación útil</span><p>¿Cada concepto clave está definido? ¿Los antecedentes explican la necesidad del estudio? ¿Las variables o categorías se relacionan con los objetivos y con los instrumentos?</p></div>
            </section>

            <section id="guia-diseno" class="ie-article-section">
                <span class="ie-article-kicker">04 · DISEÑO Y TÉCNICAS</span>
                <h2>Elige el enfoque y diseña cómo obtendrás la evidencia</h2>
                <div class="ie-approach-grid"><div><span class="ie-approach-symbol ie-approach-blue">123</span><h3>Cuantitativo</h3><p>Útil cuando el problema requiere medir variables, estimar frecuencias o examinar relaciones mediante datos numéricos y procedimientos definidos.</p></div><div><span class="ie-approach-symbol ie-approach-purple">◉</span><h3>Cualitativo</h3><p>Útil cuando la pregunta busca comprender experiencias, interpretaciones, prácticas o significados dentro de su contexto.</p></div><div><span class="ie-approach-symbol ie-approach-green">↔</span><h3>Combinado</h3><p>Integra evidencias cuantitativas y cualitativas cuando su complementariedad responde a la pregunta y el proyecto puede justificar ambas.</p></div></div>
                <p>El diseño define la estructura del estudio. Las técnicas indican cómo se recopilará información —por ejemplo, encuesta, entrevista, observación o análisis documental— y los instrumentos concretan qué se registrará. Es importante revisar su validez, claridad, consistencia y adecuación a los participantes.</p>
                <h3>Población y muestra</h3>
                <p>La población es el conjunto al que se refiere el estudio; la muestra es el subconjunto del que efectivamente se obtiene información. El tamaño no debe decidirse de forma aislada: importa cómo se seleccionan las unidades, qué precisión se busca, qué variabilidad se espera y cuáles son las restricciones del diseño.</p>
            </section>

            <section id="guia-formulas" class="ie-article-section">
                <span class="ie-article-kicker">05 · APOYO ESTADÍSTICO</span>
                <h2>Fórmulas: usa cada una en el contexto correcto</h2>
                <p>Las siguientes expresiones son herramientas generales complementarias para interpretar información cuantitativa. No son transcripciones literales del libro; confirma los supuestos de cada procedimiento antes de utilizarlas en tu trabajo académico.</p>
                <div class="ie-article-formula"><div><span>ESTIMACIÓN DE MUESTRA</span><h3>Población finita</h3></div><div class="ie-formula ie-article-formula-math"><span>n =</span><span class="ie-fraction"><span>N · Z<sup>2</sup> · p · q</span><span>e<sup>2</sup>(N − 1) + Z<sup>2</sup> · p · q</span></span></div><p><b>N</b> = tamaño poblacional; <b>Z</b> = valor del nivel de confianza; <b>e</b> = margen de error; <b>p</b> y <b>q</b> = proporciones esperadas. Esta forma es orientativa para la estimación de una proporción con muestreo aleatorio simple; no aplica automáticamente a diseños complejos.</p></div>
                <div class="ie-article-formula-pair"><div><span>PORCENTAJE</span><strong>Porcentaje = (parte / total) × 100</strong><p>Expresa una frecuencia respecto del total definido.</p></div><div><span>MEDIA ARITMÉTICA</span><strong>x̄ = Σxᵢ / n</strong><p>Resume valores numéricos; conviene analizarla junto con la dispersión y la distribución.</p></div></div>
                <a class="ie-btn ie-btn-primary ie-article-action" href="{{ route('frontend.home') }}#herramientas">Abrir calculadora de muestra <span aria-hidden="true">→</span></a>
            </section>

            <section id="guia-analisis" class="ie-article-section">
                <span class="ie-article-kicker">06 · ANÁLISIS Y COMUNICACIÓN</span>
                <h2>Analiza, interpreta y redacta sin sobrepasar la evidencia</h2>
                <p>El análisis debe seguir un plan relacionado con las preguntas y con el tipo de datos recogidos. En estudios cuantitativos puede incluir organización de frecuencias, medidas descriptivas y pruebas estadísticas según sus supuestos. En estudios cualitativos puede implicar codificación, comparación de unidades de significado, construcción de categorías y contraste con el contexto y las fuentes.</p>
                <p>Interpretar no es repetir una tabla ni convertir una asociación en causalidad sin un diseño que lo justifique. Explica qué muestran los resultados, qué no permiten afirmar, cómo dialogan con los antecedentes y qué limitaciones deben considerarse.</p>
                <h3>Prepara un informe claro</h3>
                <p>Una redacción académica eficaz busca claridad, precisión y coherencia. Verifica que cada capítulo cumpla una función, que las tablas y figuras se expliquen en el texto, que las citas correspondan con las referencias finales y que las conclusiones respondan a los objetivos.</p>
            </section>

            <section id="guia-etica" class="ie-article-section">
                <span class="ie-article-kicker">07 · ÉTICA ACADÉMICA</span>
                <h2>La integridad es parte del método</h2>
                <p>La ética científica atraviesa todo el proyecto: desde justificar la pertinencia del estudio y respetar a sus participantes hasta conservar los registros, comunicar resultados sin manipulación y reconocer las contribuciones ajenas. La cita adecuada, la atribución de autoría y la protección de información sensible no son pasos decorativos al final de la tesis.</p>
                <div class="ie-ethics-checklist"><h3>Lista de revisión antes de entregar</h3><p><span>✓</span> Las fuentes están citadas y pueden ser localizadas.</p><p><span>✓</span> Los datos no se han inventado ni alterado para obtener un resultado esperado.</p><p><span>✓</span> Se explican las limitaciones relevantes del estudio.</p><p><span>✓</span> Se protegen los datos personales y se respetan las autorizaciones correspondientes.</p><p><span>✓</span> Las conclusiones se ajustan a la evidencia y al diseño utilizado.</p></div>
            </section>

            <section class="ie-article-source" id="guia-fuente">
                <div class="ie-article-source-icon">▤</div><div><span>FUENTE PRINCIPAL DE ESTUDIO</span><h2>Metodología de la investigación total: cuantitativa-cualitativa y redacción de tesis</h2><p>Ñaupas Paitán, H., Mejía Mejía, E., Trujillo Román, I. R., Romero Delgado, H. E., Medina Bárcena, W., &amp; Novoa Ramírez, E. (2023). 6.ª edición. Ediciones de la U. ISBN 978-958-792-465-7.</p><p class="ie-article-source-note">La plataforma destaca a Humberto Ñaupas Paitán como autor de referencia, pero conserva la atribución completa de la obra en coautoría. El PDF disponible para preparar esta guía es un fragmento; consulta la edición completa para citas por página.</p></div>
            </section>
        </article>

        <aside class="ie-article-sidebar">
            <div class="ie-sidebar-card ie-sidebar-toc">
                <span class="ie-sidebar-overline">EN ESTA GUÍA</span><h2>Contenido</h2>
                <nav aria-label="Contenido de la guía"><a href="#guia-fundamentos"><span>01</span> Fundamentos científicos</a><a href="#guia-problema"><span>02</span> Problema y objetivos</a><a href="#guia-marco"><span>03</span> Marco teórico y variables</a><a href="#guia-diseno"><span>04</span> Diseño y técnicas</a><a href="#guia-formulas"><span>05</span> Fórmulas y muestra</a><a href="#guia-analisis"><span>06</span> Análisis y redacción</a><a href="#guia-etica"><span>07</span> Ética académica</a></nav>
            </div>
            <div class="ie-sidebar-card ie-sidebar-author"><span class="ie-sidebar-overline">AUTOR DE REFERENCIA</span><div class="ie-sidebar-author-mark">HÑ</div><h3>Humberto Ñaupas Paitán</h3><p>Referencia metodológica principal para esta guía educativa.</p><a href="#guia-fuente" class="ie-text-link">Ver referencia <span>→</span></a></div>
            <div class="ie-sidebar-card ie-sidebar-cta"><span class="ie-sidebar-overline">RECURSOS PRÁCTICOS</span><h3>Convierte la teoría en un plan de trabajo.</h3><p>Revisa la ruta de estudio y la calculadora de muestra disponibles en la portada.</p><a class="ie-btn ie-btn-primary" href="{{ route('frontend.home') }}#ruta">Explorar recursos <span>→</span></a></div>
            <div class="ie-sidebar-note"><span>RECUERDA</span><p>La metodología se adapta al problema y al diseño. Verifica las normas de investigación de tu universidad.</p></div>
        </aside>
    </div>

    <section class="ie-article-end"><div class="container"><div><span class="ie-eyebrow">SIGUIENTE PASO</span><h2>Ya tienes la estructura. Ahora adapta la metodología a tu problema de investigación.</h2><p>Continúa con los recursos interactivos de InvestigaEdu y consulta las indicaciones de tu asesor.</p></div><a class="ie-btn ie-btn-primary" href="{{ route('frontend.home') }}#herramientas">Ir a las herramientas <span aria-hidden="true">→</span></a></div></section>
</main>
@endsection
