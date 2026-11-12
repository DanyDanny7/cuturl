{{-- Landing de Cuturl. Identidad visual tomada de danypro.net (Daniel Bonilla):
     fuente Inter + paleta "Dark Premium" (fondo azul-negro, acento turquesa). --}}
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#0a0e14">

    {{-- Favicons / PWA (generados desde el logo danypro) --}}
    <link rel="icon" href="{{ asset('favicon.ico') }}" sizes="any">
    <link rel="icon" href="{{ asset('favicon.svg') }}" type="image/svg+xml">
    <link rel="icon" href="{{ asset('favicon-96x96.png') }}" type="image/png" sizes="96x96">
    <link rel="apple-touch-icon" href="{{ asset('apple-touch-icon.png') }}" sizes="180x180">
    <link rel="manifest" href="{{ asset('site.webmanifest') }}">

    {{-- APP_NAME = "Cuturl" (vive en .env, un solo lugar). --}}
    @php($appName = config('app.name'))
    @php($desc = 'Acorta URLs largas en enlaces cortos, seguros y sin rastro innecesario. Rápido, open source y fácil de usar.')
    @php($ogImage = url('/og-cuturl.png'))

    <title>{{ $appName }} — Acorta tus URLs | corto y seguro</title>
    <meta name="description" content="{{ $desc }}">
    <meta name="author" content="Daniel Bonilla">
    <link rel="canonical" href="{{ url()->current() }}">

    {{-- Geo (El Salvador) — mismo origen que danypro.net --}}
    <meta name="geo.region" content="SV-SS">
    <meta name="geo.placename" content="San Salvador, El Salvador">
    <meta name="geo.position" content="13.6929;-89.2182">
    <meta name="ICBM" content="13.6929, -89.2182">

    {{-- Open Graph --}}
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="{{ $appName }}">
    <meta property="og:title" content="{{ $appName }} — Acorta tus URLs">
    <meta property="og:description" content="{{ $desc }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:locale" content="es_ES">
    <meta property="og:image" content="{{ $ogImage }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:alt" content="{{ $appName }} — Acorta tus URLs">

    {{-- Twitter (cuenta de danypro) --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@DanyDanny17">
    <meta name="twitter:creator" content="@DanyDanny17">
    <meta name="twitter:title" content="{{ $appName }} — Acorta tus URLs">
    <meta name="twitter:description" content="{{ $desc }}">
    <meta name="twitter:image" content="{{ $ogImage }}">

    {{-- Datos estructurados: la app + su autor --}}
    <script type="application/ld+json">
    {!! json_encode([
        '@context' => 'https://schema.org',
        '@type' => 'WebApplication',
        'name' => $appName,
        'applicationCategory' => 'UtilitiesApplication',
        'operatingSystem' => 'Web',
        'description' => $desc,
        'url' => url('/'),
        'offers' => ['@type' => 'Offer', 'price' => '0', 'priceCurrency' => 'USD'],
        'creator' => [
            '@type' => 'Person',
            'name' => 'Daniel Bonilla',
            'url' => 'https://danypro.net',
            'sameAs' => ['https://github.com/DanyDanny7', 'https://www.linkedin.com/in/danypro-net/'],
        ],
    ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
    </script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap">

    <style>
        /* Paleta "Dark Premium" de danypro.net */
        :root {
            --bg: #0a0e14; --surface: #121824; --surface-2: #1a2130;
            --fg: #f3f1ea; --muted: #99a2b0; --border: #222c3c;
            --accent: #5ec8d6; --accent-ink: #052028; --accent-deep: #3a93a3;
            --danger: #f0776b;
            --font: Inter, ui-sans-serif, system-ui, -apple-system, "Segoe UI", Roboto, sans-serif;
        }
        * { box-sizing: border-box; }
        html { scroll-behavior: smooth; }
        body { margin: 0; min-height: 100vh; background:
            radial-gradient(1100px 680px at 85% -8%, rgba(94,200,214,.14), transparent 60%),
            radial-gradient(760px 560px at 5% 110%, rgba(94,200,214,.06), transparent 60%),
            var(--bg);
            color: var(--fg); font-family: var(--font); line-height: 1.55;
            display: flex; flex-direction: column; }
        a { color: inherit; }
        .wrap { width: 100%; max-width: 760px; margin: 0 auto; padding: 0 20px; }

        /* Header */
        header { padding: 22px 0; }
        header .wrap { display: flex; align-items: center; justify-content: space-between; gap: 16px; }
        .brand { display: inline-flex; align-items: center; gap: 11px; text-decoration: none; }
        .logo { height: 30px; width: auto; display: block; }
        .logo-sm { height: 22px; width: auto; display: block; }
        .brand .bn { font-weight: 700; letter-spacing: .14em; text-transform: uppercase; font-size: .9rem; color: var(--accent); }
        .nav-doc { text-decoration: none; font-weight: 600; font-size: .9rem; color: var(--fg);
            border: 1px solid var(--border); border-radius: 999px; padding: 8px 16px; transition: border-color .15s, background .15s; }
        .nav-doc:hover { border-color: var(--accent); background: rgba(94,200,214,.07); }
        .nav-actions { display: inline-flex; align-items: center; gap: 10px; }
        .nav-gh { display: inline-flex; align-items: center; gap: 8px; text-decoration: none;
            font-weight: 600; font-size: .9rem; color: var(--fg);
            border: 1px solid var(--border); border-radius: 999px; padding: 8px 16px;
            transition: border-color .15s, background .15s, color .15s; }
        .nav-gh:hover { border-color: var(--accent); background: rgba(94,200,214,.07); color: var(--accent); }
        .nav-gh svg { width: 17px; height: 17px; display: block; }

        /* Hero */
        main { flex: 1; }
        .hero { padding: 36px 0 20px; }
        .eyebrow { font-size: .8rem; font-weight: 600; letter-spacing: .14em; text-transform: uppercase; color: var(--accent); }
        h1 { font-size: clamp(2.4rem, 8vw, 3.9rem); font-weight: 800; letter-spacing: -0.035em; line-height: 1.02;
            margin: 14px 0 0; text-wrap: balance; }
        h1 .dot { color: var(--accent); }
        .lede { color: var(--muted); font-size: clamp(1rem, 2.6vw, 1.2rem); margin: 16px 0 0; max-width: 46ch; }

        /* Formulario */
        form { margin-top: 30px; display: flex; gap: 10px; flex-wrap: wrap; }
        input[type=url] { flex: 1 1 260px; min-width: 0; padding: 15px 17px; font-size: 1rem; font-family: inherit;
            color: var(--fg); background: var(--surface); border: 1px solid var(--border); border-radius: 12px; }
        input[type=url]::placeholder { color: #6b7589; }
        input[type=url]:focus { outline: none; border-color: var(--accent); box-shadow: 0 0 0 3px rgba(94,200,214,.18); }
        button[type=submit] { padding: 15px 26px; font-size: 1rem; font-weight: 700; font-family: inherit; cursor: pointer;
            color: var(--accent-ink); background: var(--accent); border: 0; border-radius: 12px; transition: transform .05s, filter .15s; }
        button[type=submit]:hover { filter: brightness(1.07); }
        button[type=submit]:active { transform: translateY(1px); }
        .error { margin: 12px 0 0; color: var(--danger); font-size: .92rem; }

        /* Resultado */
        .result { margin-top: 20px; background: var(--surface); border: 1px solid var(--accent);
            border-radius: 14px; padding: 18px 20px; }
        .result .lbl { font-size: .74rem; letter-spacing: .1em; text-transform: uppercase; color: var(--muted); }
        .result .row { display: flex; align-items: center; gap: 12px; margin-top: 7px; flex-wrap: wrap; }
        .result a.short { font-size: 1.3rem; font-weight: 700; color: var(--accent); text-decoration: none; word-break: break-all; }
        .result a.short:hover { text-decoration: underline; }
        .copy { margin-left: auto; font: inherit; font-size: .85rem; font-weight: 600; cursor: pointer; color: var(--fg);
            background: var(--surface-2); border: 1px solid var(--border); border-radius: 9px; padding: 8px 14px; }
        .copy:hover { border-color: var(--accent); }
        .result .dest { margin-top: 8px; color: var(--muted); font-size: .82rem; word-break: break-all; }

        /* CTA documentación */
        .docs-cta { margin: 48px 0 10px; background: linear-gradient(135deg, rgba(94,200,214,.1), rgba(94,200,214,.03));
            border: 1px solid var(--border); border-radius: 18px; padding: 26px 24px;
            display: flex; align-items: center; gap: 20px; flex-wrap: wrap; }
        .docs-cta .txt { flex: 1 1 240px; min-width: 0; }
        .docs-cta h2 { margin: 0; font-size: 1.4rem; font-weight: 800; letter-spacing: -0.02em; }
        .docs-cta p { margin: 6px 0 0; color: var(--muted); font-size: .95rem; }
        .docs-btn { text-decoration: none; white-space: nowrap; font-weight: 700; font-size: 1rem;
            color: var(--accent-ink); background: var(--accent); border-radius: 12px; padding: 14px 24px;
            display: inline-flex; align-items: center; gap: 9px; box-shadow: 0 8px 26px rgba(94,200,214,.28); transition: transform .05s, filter .15s; }
        .docs-btn:hover { filter: brightness(1.07); }
        .docs-btn:active { transform: translateY(1px); }
        .docs-btn .ar { transition: transform .15s; } .docs-btn:hover .ar { transform: translateX(3px); }

        /* CTA del código */
        .code-cta { margin: 14px 0 10px; background: var(--surface-2, #1a2130);
            border: 1px solid var(--border); border-radius: 18px; padding: 22px 24px;
            display: flex; align-items: center; gap: 20px; flex-wrap: wrap; }
        .code-cta .txt { flex: 1 1 240px; min-width: 0; }
        .code-cta h2 { margin: 0; font-size: 1.15rem; font-weight: 800; letter-spacing: -0.02em; display: inline-flex; align-items: center; gap: 9px; }
        .code-cta h2 svg { width: 20px; height: 20px; }
        .code-cta p { margin: 6px 0 0; color: var(--muted); font-size: .92rem; }
        .code-btn { text-decoration: none; white-space: nowrap; font-weight: 700; font-size: .98rem;
            color: var(--fg); background: rgba(255,255,255,.04); border: 1px solid var(--border); border-radius: 12px; padding: 13px 22px;
            display: inline-flex; align-items: center; gap: 10px; transition: transform .05s, border-color .15s, background .15s; }
        .code-btn svg { width: 18px; height: 18px; }
        .code-btn:hover { border-color: var(--accent); background: rgba(94,200,214,.08); }
        .code-btn:active { transform: translateY(1px); }

        /* Píldora de código en el footer (igual que el header) */
        .f-gh { display: inline-flex; align-items: center; gap: 7px; text-decoration: none;
            color: var(--fg); border: 1px solid var(--border); border-radius: 999px; padding: 6px 13px;
            font-weight: 600; transition: border-color .15s, background .15s, color .15s; }
        .f-gh svg { width: 15px; height: 15px; }
        .f-gh:hover { border-color: var(--accent); background: rgba(94,200,214,.07); color: var(--accent); }

        /* Footer */
        footer { margin-top: 56px; border-top: 1px solid var(--border); padding: 26px 0 40px; }
        footer .wrap { display: flex; align-items: center; justify-content: space-between; gap: 14px; flex-wrap: wrap; }
        .f-made { color: var(--muted); font-size: .9rem; display: inline-flex; align-items: center; gap: 10px; }
        .f-made a { color: var(--accent); text-decoration: none; font-weight: 600; }
        .f-made a:hover { text-decoration: underline; }
        .f-links { display: flex; gap: 16px; font-size: .88rem; }
        .f-links a { color: var(--muted); text-decoration: none; }
        .f-links a:hover { color: var(--fg); }

        .toast { position: fixed; left: 50%; bottom: 26px; transform: translateX(-50%) translateY(20px);
            background: var(--accent); color: var(--accent-ink); font-weight: 700; font-size: .9rem;
            padding: 11px 20px; border-radius: 999px; opacity: 0; pointer-events: none; transition: opacity .2s, transform .2s; }
        .toast.show { opacity: 1; transform: translateX(-50%) translateY(0); }
    </style>
</head>
<body>
    <header>
        <div class="wrap">
            <a class="brand" href="{{ route('links.create') }}">
                <img class="logo" src="{{ asset('logo.png') }}" alt="" width="36" height="30">
                <span class="bn">{{ $appName }}</span>
            </a>
            {{-- Acceso directo a la documentación y al código fuente --}}
            <nav class="nav-actions">
                <a class="nav-doc" href="/explicacion.html">¿Cómo funciona?</a>
                <a class="nav-gh" href="https://github.com/DanyDanny7/cuturl" target="_blank" rel="noopener" title="Ver el código en GitHub">
                    <svg viewBox="0 0 16 16" fill="currentColor" aria-hidden="true"><path d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27.68 0 1.36.09 2 .27 1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.01 8.01 0 0 0 16 8c0-4.42-3.58-8-8-8z"/></svg>
                    <span>Código</span>
                </a>
            </nav>
        </div>
    </header>

    <main>
        <section class="hero wrap">
            <span class="eyebrow">Acortador de URLs · corto + seguro</span>
            <h1>Acorta tus enlaces<span class="dot">.</span></h1>
            <p class="lede">Pega una URL larga y recibe un enlace corto, seguro y fácil de compartir. Sin cuentas, sin rastro innecesario.</p>

            <form method="POST" action="{{ route('links.store') }}">
                @csrf
                <input type="url" name="destination" inputmode="url"
                       placeholder="https://ejemplo.com/una-url-muy-larga"
                       value="{{ old('destination') }}" required autofocus>
                <button type="submit">Acortar</button>
            </form>

            @error('destination')
                <p class="error">{{ $message }}</p>
            @enderror

            @if (session('shortUrl'))
                <div class="result">
                    <span class="lbl">Tu enlace corto</span>
                    <div class="row">
                        <a class="short" href="{{ session('shortUrl') }}" target="_blank" rel="noopener" id="shortUrl">{{ session('shortUrl') }}</a>
                        <button type="button" class="copy" data-copy="{{ session('shortUrl') }}">Copiar</button>
                    </div>
                    <div class="dest">→ {{ session('destination') }}</div>
                </div>
            @endif

            {{-- CTA llamativo a la documentación --}}
            <div class="docs-cta">
                <div class="txt">
                    <h2>¿Y cómo funciona?</h2>
                    <p>Mira por dentro: la arquitectura, el flujo de una petición y el código de cada archivo, explicado paso a paso.</p>
                </div>
                <a class="docs-btn" href="/explicacion.html">Ver la documentación <span class="ar">→</span></a>
            </div>

            {{-- CTA al código fuente --}}
            <div class="code-cta">
                <div class="txt">
                    <h2><svg viewBox="0 0 16 16" fill="currentColor" aria-hidden="true"><path d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27.68 0 1.36.09 2 .27 1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.01 8.01 0 0 0 16 8c0-4.42-3.58-8-8-8z"/></svg>Código abierto</h2>
                    <p>Todo el proyecto está disponible en GitHub. Explóralo, clónalo o úsalo de referencia.</p>
                </div>
                <a class="code-btn" href="https://github.com/DanyDanny7/cuturl" target="_blank" rel="noopener">
                    <svg viewBox="0 0 16 16" fill="currentColor" aria-hidden="true"><path d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27.68 0 1.36.09 2 .27 1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.01 8.01 0 0 0 16 8c0-4.42-3.58-8-8-8z"/></svg>
                    Ver el código en GitHub
                </a>
            </div>
        </section>
    </main>

    <footer>
        <div class="wrap">
            <span class="f-made"><img class="logo-sm" src="{{ asset('logo.png') }}" alt="">Hecho por <a href="https://danypro.net" target="_blank" rel="noopener">Daniel Bonilla · danypro.net</a></span>
            <nav class="f-links">
                <a href="/explicacion.html">Documentación</a>
                <a class="f-gh" href="https://github.com/DanyDanny7/cuturl" target="_blank" rel="noopener">
                    <svg viewBox="0 0 16 16" fill="currentColor" aria-hidden="true"><path d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27.68 0 1.36.09 2 .27 1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.01 8.01 0 0 0 16 8c0-4.42-3.58-8-8-8z"/></svg>
                    Código
                </a>
            </nav>
        </div>
    </footer>

    <div class="toast" id="toast">¡Copiado!</div>

    <script>
        // Botón copiar con respaldo si el navegador bloquea el portapapeles.
        document.querySelectorAll('.copy').forEach(function (btn) {
            btn.addEventListener('click', function () {
                var text = btn.getAttribute('data-copy');
                function ok() {
                    var t = document.getElementById('toast');
                    t.classList.add('show'); setTimeout(function () { t.classList.remove('show'); }, 1500);
                }
                if (navigator.clipboard && navigator.clipboard.writeText) {
                    navigator.clipboard.writeText(text).then(ok).catch(fallback);
                } else { fallback(); }
                function fallback() {
                    var el = document.getElementById('shortUrl');
                    var r = document.createRange(); r.selectNodeContents(el);
                    var sel = window.getSelection(); sel.removeAllRanges(); sel.addRange(r);
                    try { document.execCommand('copy'); ok(); } catch (e) {}
                }
            });
        });
    </script>
</body>
</html>
