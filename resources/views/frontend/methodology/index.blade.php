@extends("frontend.master")

@section("title", "Metodología y calculadoras")

@section("style")
<style>
    .methodology-page { padding: 130px 0 70px; background: #f5f7fb; }
    .methodology-intro, .formula-card { background: #fff; border-radius: 16px; box-shadow: 0 10px 35px rgba(20, 43, 74, .08); }
    .methodology-intro { display: grid; grid-template-columns: minmax(180px, 260px) 1fr; gap: 34px; padding: 32px; align-items: center; }
    .methodology-intro img { display: block; width: 100%; max-height: 360px; object-fit: contain; }
    .methodology-intro h1 { font-size: clamp(2rem, 4vw, 3.2rem); line-height: 1.1; color: #172a46; }
    .methodology-intro p { color: #59697e; line-height: 1.7; }
    .methodology-intro .authors { font-weight: 600; color: #293d59; }
    .formula-section { margin-top: 40px; }
    .formula-section > h2 { color: #172a46; margin-bottom: 8px; }
    .formula-section > p { color: #64748b; margin-bottom: 22px; }
    .formula-grid { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 20px; }
    .formula-card { padding: 25px; }
    .formula-card h3 { color: #172a46; font-size: 1.25rem; }
    .formula-equation { display: block; padding: 13px 15px; margin: 15px 0; border-radius: 8px; background: #eff5ff; color: #1b4e91; font-family: Georgia, serif; font-size: 1.15rem; overflow-wrap: anywhere; }
    .formula-card label { display: block; margin: 12px 0 5px; font-weight: 600; color: #34445a; }
    .formula-card input { width: 100%; border: 1px solid #d5deeb; border-radius: 7px; padding: 10px 12px; }
    .formula-result { min-height: 28px; margin: 15px 0 0; font-weight: 700; color: #18764a; }
    .formula-result.is-error { color: #b42318; }
    .methodology-note { margin-top: 25px; color: #64748b; font-size: .92rem; }
    @media (max-width: 760px) {
        .methodology-page { padding-top: 100px; }
        .methodology-intro { grid-template-columns: 1fr; }
        .methodology-intro img { max-width: 190px; margin: auto; }
        .formula-grid { grid-template-columns: 1fr; }
    }
</style>
@endsection

@section("content")
<main class="methodology-page">
    <div class="container">
        <section class="methodology-intro">
            <img src="{{ asset('assets/metodologia-investigacion-total.png') }}" alt="Portada del libro Metodología de la investigación total">
            <div>
                <span class="methodology-eyebrow">Biblioteca metodológica</span>
                <h1>Metodología de la investigación total</h1>
                <p>Un espacio para apoyar el diseño de estudios, la recolección de datos y el análisis cuantitativo con calculadoras interactivas.</p>
                <p class="authors">Humberto Ñaupas Paitán, Elías Mejía Mejía, Ismael Ramiro Trujillo Román, Hugo Eusebio Romero Delgado, Wilfredo Medina Bárcena y Eliana Novoa Ramírez · 6.ª edición.</p>
                <p>Las calculadoras presentan fórmulas estadísticas de uso general para fines educativos. Verifica los supuestos, el diseño muestral y los criterios de tu institución antes de usar los resultados en una tesis.</p>
                @auth
                    <a class="btn btn-primary" href="{{ route('dashboard.surveys.index') }}">Crear o administrar encuestas</a>
                @else
                    <a class="btn btn-primary" href="{{ route('auth.login') }}">Ingresar para administrar encuestas</a>
                @endauth
            </div>
        </section>

        <section class="formula-section" aria-labelledby="calculadoras-titulo">
            <h2 id="calculadoras-titulo">Calculadoras de apoyo</h2>
            <p>Introduce tus datos; los cálculos se realizan en tu navegador y no se guardan.</p>
            <div class="formula-grid">
                <article class="formula-card">
                    <h3>Tamaño de muestra</h3>
                    <p>Estimación para proporciones con población finita o desconocida.</p>
                    <span class="formula-equation">n = (Z² · p · q · N) / (e² · (N − 1) + Z² · p · q)</span>
                    <form data-calculator="sample">
                        <label for="population">Población N (0 si es desconocida)</label>
                        <input id="population" name="population" type="number" min="0" step="1" value="1000" required>
                        <label for="confidence">Nivel de confianza</label>
                        <select id="confidence" name="confidence" class="form-control">
                            <option value="1.645">90 %</option>
                            <option value="1.96" selected>95 %</option>
                            <option value="2.576">99 %</option>
                        </select>
                        <label for="margin">Margen de error e (%)</label>
                        <input id="margin" name="margin" type="number" min="0.01" max="99.99" step="0.01" value="5" required>
                        <label for="proportion">Proporción esperada p (%)</label>
                        <input id="proportion" name="proportion" type="number" min="0.01" max="99.99" step="0.01" value="50" required>
                        <button class="btn btn-primary mt-3" type="submit">Calcular muestra</button>
                        <p class="formula-result" aria-live="polite"></p>
                    </form>
                </article>

                <article class="formula-card">
                    <h3>Consistencia interna (alfa de Cronbach)</h3>
                    <p>Ingresa la varianza de cada ítem y la varianza de la puntuación total.</p>
                    <span class="formula-equation">α = k / (k − 1) · (1 − Σσ²ᵢ / σ²ₜ)</span>
                    <form data-calculator="cronbach">
                        <label for="itemVariances">Varianzas por ítem, separadas por coma</label>
                        <input id="itemVariances" name="itemVariances" type="text" inputmode="decimal" placeholder="0.8, 1.1, 0.9" required>
                        <label for="totalVariance">Varianza de la puntuación total</label>
                        <input id="totalVariance" name="totalVariance" type="number" min="0.000001" step="any" required>
                        <button class="btn btn-primary mt-3" type="submit">Calcular alfa</button>
                        <p class="formula-result" aria-live="polite"></p>
                    </form>
                </article>

                <article class="formula-card">
                    <h3>Correlación de Pearson</h3>
                    <p>Introduce pares de observaciones en el mismo orden y separados por coma.</p>
                    <span class="formula-equation">r = Σ[(xᵢ − x̄)(yᵢ − ȳ)] / √[Σ(xᵢ − x̄)² · Σ(yᵢ − ȳ)²]</span>
                    <form data-calculator="pearson">
                        <label for="valuesX">Valores X</label>
                        <input id="valuesX" name="valuesX" type="text" inputmode="decimal" placeholder="2, 4, 6, 8" required>
                        <label for="valuesY">Valores Y</label>
                        <input id="valuesY" name="valuesY" type="text" inputmode="decimal" placeholder="3, 5, 6, 9" required>
                        <button class="btn btn-primary mt-3" type="submit">Calcular correlación</button>
                        <p class="formula-result" aria-live="polite"></p>
                    </form>
                </article>

                <article class="formula-card">
                    <h3>Estadísticos descriptivos</h3>
                    <p>Obtén la media, mediana y desviación estándar muestral de una lista.</p>
                    <span class="formula-equation">x̄ = Σxᵢ / n &nbsp; · &nbsp; s = √[Σ(xᵢ − x̄)² / (n − 1)]</span>
                    <form data-calculator="descriptive">
                        <label for="dataValues">Datos separados por coma</label>
                        <input id="dataValues" name="dataValues" type="text" inputmode="decimal" placeholder="12, 14, 15, 18" required>
                        <button class="btn btn-primary mt-3" type="submit">Calcular descriptivos</button>
                        <p class="formula-result" aria-live="polite"></p>
                    </form>
                </article>
            </div>
            <p class="methodology-note">Referencia bibliográfica de la portada: <em>Metodología de la investigación total: cuantitativa, cualitativa y redacción de tesis</em>, 6.ª edición. Esta página incluye herramientas originales de apoyo; no reproduce el contenido completo del libro ni sustituye su consulta.</p>
        </section>
    </div>
</main>
@endsection

@section("script")
<script>
(() => {
    const parseList = (value) => {
        const parts = value.split(',').map((item) => item.trim());
        return parts.some((item) => item === '') ? [Number.NaN] : parts.map(Number);
    };
    const format = (value) => new Intl.NumberFormat('es-PE', { maximumFractionDigits: 4 }).format(value);
    const show = (form, message, isError = false) => {
        const output = form.querySelector('.formula-result');
        output.textContent = message;
        output.classList.toggle('is-error', isError);
    };

    document.querySelectorAll('[data-calculator]').forEach((form) => {
        form.addEventListener('submit', (event) => {
            event.preventDefault();
            const values = new FormData(form);
            const fail = (message) => show(form, message, true);

            if (form.dataset.calculator === 'sample') {
                const rawPopulation = String(values.get('population')).trim();
                const population = Number(rawPopulation);
                const z = Number(values.get('confidence'));
                const margin = Number(values.get('margin')) / 100;
                const p = Number(values.get('proportion')) / 100;
                if (rawPopulation === '' || !Number.isFinite(population) || population < 0 || margin <= 0 || margin >= 1 || p <= 0 || p >= 1) {
                    return fail('Revisa los valores: N debe ser ≥ 0; e y p deben estar entre 0 y 100 %.');
                }
                const q = 1 - p;
                const numerator = z * z * p * q;
                const n = population > 0
                    ? (numerator * population) / (margin * margin * (population - 1) + numerator)
                    : numerator / (margin * margin);
                return show(form, `Tamaño mínimo recomendado: ${Math.ceil(n)} participantes (sin ajuste por no respuesta).`);
            }

            if (form.dataset.calculator === 'cronbach') {
                const variances = parseList(String(values.get('itemVariances')));
                const totalVariance = Number(values.get('totalVariance'));
                if (variances.length < 2 || variances.some((number) => !Number.isFinite(number) || number < 0) || totalVariance <= 0) {
                    return fail('Se requieren al menos dos varianzas de ítems no negativas y una varianza total mayor que cero.');
                }
                const alpha = (variances.length / (variances.length - 1)) * (1 - variances.reduce((sum, item) => sum + item, 0) / totalVariance);
                return show(form, `Alfa de Cronbach: ${format(alpha)}. Interpreta el valor según el instrumento y su contexto.`);
            }

            if (form.dataset.calculator === 'pearson') {
                const x = parseList(String(values.get('valuesX')));
                const y = parseList(String(values.get('valuesY')));
                if (x.length < 3 || x.length !== y.length || x.concat(y).some((number) => !Number.isFinite(number))) {
                    return fail('Ingresa al menos tres pares numéricos; ambas listas deben tener la misma cantidad.');
                }
                const meanX = x.reduce((sum, item) => sum + item, 0) / x.length;
                const meanY = y.reduce((sum, item) => sum + item, 0) / y.length;
                const numerator = x.reduce((sum, item, index) => sum + (item - meanX) * (y[index] - meanY), 0);
                const sumX = x.reduce((sum, item) => sum + (item - meanX) ** 2, 0);
                const sumY = y.reduce((sum, item) => sum + (item - meanY) ** 2, 0);
                if (sumX === 0 || sumY === 0) return fail('No se puede calcular r si una de las variables no presenta variación.');
                return show(form, `Coeficiente de correlación de Pearson: r = ${format(numerator / Math.sqrt(sumX * sumY))}.`);
            }

            const data = parseList(String(values.get('dataValues')));
            if (data.length < 2 || data.some((number) => !Number.isFinite(number))) {
                return fail('Ingresa al menos dos valores numéricos separados por comas.');
            }
            const sorted = [...data].sort((a, b) => a - b);
            const mean = data.reduce((sum, item) => sum + item, 0) / data.length;
            const middle = Math.floor(sorted.length / 2);
            const median = sorted.length % 2 ? sorted[middle] : (sorted[middle - 1] + sorted[middle]) / 2;
            const deviation = Math.sqrt(data.reduce((sum, item) => sum + (item - mean) ** 2, 0) / (data.length - 1));
            show(form, `n = ${data.length} · Media = ${format(mean)} · Mediana = ${format(median)} · Desviación estándar muestral = ${format(deviation)}.`);
        });
    });
})();
</script>
@endsection
