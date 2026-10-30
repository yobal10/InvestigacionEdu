<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Post;

class PublicPortalController extends Controller
{
    private const ARTICLES = [
        [
            "slug" => "metodologia-de-estudios-online",
            "title" => "Metodología de estudios online: ¿cómo aplicarla de manera correcta?",
            "category" => "Encuestas",
            "date" => "28 oct, 2026",
            "excerpt" => "Una guía práctica para planificar, recopilar y analizar información con una metodología rigurosa en entornos digitales.",
            "sections" => [
                ["heading" => "¿Qué es la metodología de estudios online?", "paragraphs" => [
                    "Los estudios online utilizan medios digitales para obtener información de personas y organizaciones. La calidad de sus resultados depende del planteamiento del problema, la selección de participantes y la consistencia de los instrumentos.",
                    "Antes de publicar una encuesta, conviene precisar los objetivos, las variables de interés y el tipo de evidencia que será necesario recoger.",
                ]],
                ["heading" => "Pasos para organizar un estudio digital", "paragraphs" => [
                    "Primero se define el problema de investigación y se identifican las preguntas que el estudio debe responder. Después se elige el enfoque metodológico, se diseña el cuestionario y se determina la muestra.",
                    "Durante la recolección, las respuestas deben registrarse de forma ordenada y segura. El análisis posterior reúne tablas, gráficos y criterios de interpretación que permitan obtener conclusiones sustentadas.",
                ]],
                ["heading" => "Buenas prácticas para obtener resultados confiables", "paragraphs" => [
                    "Utiliza preguntas claras, evita opciones ambiguas y realiza una prueba piloto con un grupo pequeño antes de compartir la encuesta. Revisa los requisitos de consentimiento y protección de datos aplicables.",
                    "Al finalizar, presenta los principales hallazgos de manera transparente e incluye las limitaciones del estudio. Una plataforma de encuestas puede facilitar este trabajo, pero no reemplaza el criterio metodológico.",
                ]],
            ],
        ],
        [
            "slug" => "sesgo-de-medicion",
            "title" => "Sesgo de medición: qué es, tipos y cómo prevenirlo",
            "category" => "Investigación",
            "date" => "14 jul, 2026",
            "excerpt" => "Conoce los errores más comunes al construir cuestionarios y cómo reducir sus efectos.",
            "sections" => [
                ["heading" => "¿Por qué aparece el sesgo de medición?", "paragraphs" => [
                    "Cuando una pregunta induce una respuesta, contiene términos confusos o presenta opciones desequilibradas, los datos pueden perder precisión. El sesgo también puede aparecer por el entorno de aplicación y la forma en que se registra la información.",
                ]],
                ["heading" => "Cómo reducirlo", "paragraphs" => [
                    "Redacta preguntas neutrales, utiliza escalas coherentes y prueba el formulario antes del lanzamiento. Documenta los cambios y conserva una versión estable del instrumento durante el levantamiento de datos.",
                ]],
            ],
        ],
        [
            "slug" => "crear-encuestas",
            "title" => "Cómo crear una encuesta online paso a paso",
            "category" => "Encuestas",
            "date" => "21 oct, 2026",
            "excerpt" => "Organiza tus preguntas y publica un formulario intuitivo para los participantes.",
            "sections" => [
                ["heading" => "Empieza con un objetivo claro", "paragraphs" => [
                    "Define qué información necesitas y a quién va dirigido el instrumento. Agrupa las preguntas por tema y utiliza una estructura sencilla.",
                ]],
                ["heading" => "Prueba y comparte tu encuesta", "paragraphs" => [
                    "Revisa las preguntas obligatorias, la navegación y la presentación móvil. Una vez comprobado el funcionamiento, publica el formulario y verifica sus resultados.",
                ]],
            ],
        ],
        [
            "slug" => "analisis-de-resultados",
            "title" => "Cómo analizar los resultados de una encuesta",
            "category" => "Analítica",
            "date" => "19 oct, 2026",
            "excerpt" => "Aprende a resumir respuestas con indicadores, porcentajes y gráficos comprensibles.",
            "sections" => [
                ["heading" => "Del dato al hallazgo", "paragraphs" => [
                    "Una tabla de frecuencias permite reconocer tendencias y revisar la distribución de las respuestas. Los gráficos ayudan a comparar categorías cuando se utilizan escalas apropiadas.",
                ]],
                ["heading" => "Interpretar con contexto", "paragraphs" => [
                    "Los resultados deben examinarse junto con el tamaño de muestra, la formulación de preguntas y las limitaciones del estudio. Las correlaciones no demuestran por sí solas causalidad.",
                ]],
            ],
        ],
    ];

    public function home()
    {
        return $this->page("inicio");
    }

    public function page(string $pageKey)
    {
        $posts = Post::with("category")
            ->where("status", true)
            ->orderByDesc("id")
            ->limit(12)
            ->get();

        return view("frontend.public-site.page", [
            "pageKey" => $pageKey,
            "articles" => self::ARTICLES,
            "posts" => $posts,
        ]);
    }

    public function article(string $slug)
    {
        $article = null;

        foreach (self::ARTICLES as $candidate) {
            if ($candidate["slug"] === $slug) {
                $article = $candidate;
                break;
            }
        }

        abort_if($article === null, 404);

        return view("frontend.public-site.page", [
            "article" => $article,
            "articles" => self::ARTICLES,
            "relatedArticles" => array_values(array_filter(self::ARTICLES, fn ($item) => $item["slug"] !== $slug)),
        ]);
    }
}