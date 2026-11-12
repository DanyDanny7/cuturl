<p align="center">
  <img src="public/logo.png" width="90" alt="Cuturl">
</p>

<h1 align="center">Cuturl</h1>

<p align="center">Acortador de URLs minimalista y escalable, construido con Laravel.</p>

---

## ¿Qué es Cuturl?

**Cuturl** (de *cut* + *url*) convierte enlaces largos en códigos cortos y los
redirige. Está pensado para empezar mínimo pero poder crecer **sin reescrituras**:
la arquitectura aísla los tres puntos que suelen cambiar en un acortador para que
las features futuras sean *aditivas*.

- **Crear:** pegas una URL destino → se genera un código corto único → se guarda.
- **Resolver:** `GET /{code}` busca el enlace y redirige (301) al destino.

## Arquitectura: los 3 puntos de cambio

El diseño separa a propósito lo que va a evolucionar:

| Punto | Hoy (MVP) | Mañana (aditivo) |
|---|---|---|
| **Generación de código** | `RandomCodeGenerator` (6 chars, alfabeto sin ambigüedad) | Implementación con **Sqids** — solo se cambia el *binding* del contenedor |
| **Validación de URL** | `StoreLinkRequest` (http/https) | Regla `SafeUrl` (bloquear IPs internas, anti-SSRF) |
| **Resolución** | un método `resolve()` | expiración / contraseña / interstitial / analítica de clics |

La generación de código vive detrás de una **interfaz** (`CodeGenerator`), inyectada
vía el contenedor de servicios. Cambiar de aleatorio a Sqids es **una línea** en
`AppServiceProvider`.

## Stack

- **Laravel 13** · **PHP 8.5**
- **SQLite** (cero configuración)
- Blade para las vistas

## Puesta en marcha

```sh
# 1. Dependencias
composer install

# 2. Entorno
cp .env.example .env
php artisan key:generate

# 3. Base de datos (SQLite)
php artisan migrate

# 4. Servir
php artisan serve
```

La app queda en `http://127.0.0.1:8000`. En Windows con **Laravel Herd** se sirve
en `http://url-shortener.test` mediante `herd link`.

## Estructura relevante

```
app/
  Http/
    Controllers/LinkController.php   # crear, guardar y resolver
    Requests/StoreLinkRequest.php    # validación de la URL destino
  Models/Link.php                    # code + destination
  Providers/AppServiceProvider.php   # binding CodeGenerator -> impl.
  Services/CodeGenerator/            # interfaz + implementación aleatoria
routes/web.php                       # /  ·  POST /links  ·  GET /{code}
resources/views/links/create.blade.php
public/explicacion.html              # documentación interactiva del proyecto
```

## Documentación

El proyecto incluye una **explicación interactiva** paso a paso (de lo general a lo
específico, archivo por archivo) disponible en `/explicacion.html` una vez
levantado el servidor.

---

<p align="center">Hecho por <a href="https://danypro.net">Daniel Bonilla · danypro.net</a></p>
