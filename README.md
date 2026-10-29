# Laravel Blog

Un proyecto de blog multiusuario que utiliza Laravel 10.

## Características

- Multi usuario (Administrador, Autor, Visitante)
- Sistema de comentarios y respuestas (incluidos los comentarios de invitados)
- Publicación destacada, Publicación popular
- Módulo de categoría, etiqueta y búsqueda
- Biblioteca multimedia
- Páginas
- Encabezado y pie de página dinámicos
- Reciclaje de publicaciones, comentarios y categorías
- etc.

## Instalación

- Clone this repository
```
git clone https://github.com/jairmmz/institutescientificmethods
```
- Ir al directorio del proyecto
```
cd institutescientificmethods
```
- Copiar el archivo .env.example a .env
```
cp .env.example .env
```
- Instalar composer
```
composer i
```
- Generar la clave de la aplicación
```
php artisan key:generate
```
- Actualizar la información de la base de datos en el archivo .env
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=db_institutescientificmethods
DB_USERNAME=root
DB_PASSWORD=password
```
- Correr las migraciones
```
php artisan migrate
```
- Seed la base de datos
```
php artisan db:seed
```
- Arrancar el servidor
```
php artisan serve
```
- Visitar la aplicación
```
http://127.0.0.1:8000/
```

## Módulo de encuestas y metodología

El panel conserva las funciones del blog y añade un módulo de encuestas autenticado. Cada usuario gestiona sus propias encuestas; el administrador puede gestionarlas todas. Se pueden redactar encuestas con selección única o múltiple, texto, Likert, NPS, estrellas, lista desplegable, número y fecha; publicarlas mediante un enlace público; consultar respuestas y exportarlas a CSV.

La migración `2026_10_29_000001_create_surveys_and_responses_tables.php` crea las tablas `surveys` y `survey_responses`. En instalaciones existentes que usan migraciones, ejecutar `php artisan migrate` después de actualizar el código. El volcado local de base de datos no se incluye en Git para evitar publicar datos de cuentas; conserva una copia protegida y respáldala antes de migrar. Las respuestas son anónimas en esta versión.

La sección pública `/metodologia` y la tarjeta del panel presentan la referencia bibliográfica *Metodología de la investigación total*, 6.ª edición, con Humberto Ñaupas Paitán y coautores. Incluye calculadoras de tamaño de muestra, alfa de Cronbach, correlación de Pearson y estadísticos descriptivos. Los cálculos se ejecutan en el navegador y no se almacenan. El repositorio incluye la imagen de portada compartida para esta integración; antes de publicar el sitio, confirma que tienes los permisos de uso de la imagen. No se distribuye el PDF ni se copia su contenido extenso.

## Detalles de la cuenta de administrador
- Credenciales
```
Username:admin
Password:admin
```
