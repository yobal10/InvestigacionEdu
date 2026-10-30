# Actualizar el portal en CyberPanel mediante Git

El ZIP de referencia solo se utilizó para tomar como modelo el diseño público. No hace falta subirlo ni desplegarlo. Esta aplicación conserva el blog, el panel, las cuentas, las encuestas y sus respuestas, además de la sección de metodología.

El servidor ya tiene una copia Git en `/home/investigacionedu.exnor.site/public_html`. Este procedimiento publica los cambios del portal desde el repositorio, sin reemplazar `.env`, importar volcados ni borrar datos.

## 1. Publicar los cambios desde la terminal de VS Code en Windows

Abre el proyecto local y comprueba la rama y los cambios:

```powershell
cd "C:\Users\Mario\OneDrive\Escritorio\practicas\InvestigacionEdu"
git status
git branch --show-current
```

La rama de producción del servidor debe ser `main`. Cuando quieras publicar los cambios locales, guarda solo los cambios del portal y sus pruebas:

```powershell
git add .gitignore README.md routes/web.php phpunit.xml tests/Feature/ExampleTest.php docs/DEPLOY_CYBERPANEL.md app/Http/Controllers/Frontend/PublicPortalController.php app/Http/Controllers/Frontend/ResearchGuideController.php public/assets/frontend/css/public-site.css public/assets/frontend/css/public-site-overrides.css public/assets/frontend/js/public-site.js public/assets/frontend/images resources/views/frontend/public-site resources/views/frontend/research
git commit -m "Actualizar portal público con diseño de referencia"
git push origin main
```

No agregues `.env`, volcados SQL, bases de datos ni archivos de configuración privados. Confirma que el `git push` termina correctamente antes de pasar al servidor.

## 2. Actualizar el código en el servidor

Conéctate por SSH y confirma la raíz de Laravel:

```bash
APP_DIR="/home/investigacionedu.exnor.site/public_html"
test -f "$APP_DIR/artisan" && test -f "$APP_DIR/.env" || { echo "No se encontró la aplicación o .env; detener." >&2; exit 1; }
```

Antes de actualizar, crea un respaldo de la base de datos desde CyberPanel. Revisa si el servidor tiene cambios locales:

```bash
runuser -u inves9394 -- git -C "$APP_DIR" status --short
runuser -u inves9394 -- git -C "$APP_DIR" branch --show-current
```

Si `git status` muestra archivos modificados o la rama no es `main`, detente y revisa esos cambios antes de continuar. Si está limpio y está en la rama correcta:

```bash
runuser -u inves9394 -- git -C "$APP_DIR" pull --ff-only origin main
runuser -u inves9394 -- composer -d "$APP_DIR" install --no-dev --optimize-autoloader
runuser -u inves9394 -- php "$APP_DIR/artisan" migrate:status
```

Si Composer o `migrate:status` muestra un error, detente y corrige el problema. Con el respaldo de la base confirmado, aplica únicamente las migraciones pendientes y limpia los cachés:

```bash
runuser -u inves9394 -- php "$APP_DIR/artisan" migrate --force
runuser -u inves9394 -- php "$APP_DIR/artisan" optimize:clear
runuser -u inves9394 -- php "$APP_DIR/artisan" config:cache
runuser -u inves9394 -- php "$APP_DIR/artisan" route:cache
runuser -u inves9394 -- php "$APP_DIR/artisan" view:cache
```

Conserva el `.env`, el `APP_KEY`, las credenciales de la base de datos y el almacenamiento. No ejecutes `db:seed`, `migrate:fresh`, `migrate:refresh` ni `db:wipe`.

## 3. Verificar el sitio

Abre `https://investigacionedu.exnor.site/` y prueba el menú y la navegación del portal. Comprueba también `/metodologia`, el inicio de sesión, el panel, las encuestas existentes y un enlace público de encuesta. Los registros y publicaciones deben seguir disponibles.
