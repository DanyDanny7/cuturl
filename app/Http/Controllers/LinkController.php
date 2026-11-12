<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLinkRequest;
use App\Models\Link;
use App\Services\CodeGenerator\CodeGenerator;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

/**
 * Controller "delgado": no contiene lógica de negocio pesada, solo orquesta.
 *
 * - La generación del código la delega en CodeGenerator (inyectado).
 * - La validación la hace StoreLinkRequest antes de entrar al método.
 * - La resolución (resolve) es el método que, con el tiempo, crecerá para
 *   manejar expiración, contraseña, interstitial y analítica. Ese crecimiento
 *   queda contenido AQUÍ, en un solo lugar (punto de cambio #3).
 */
class LinkController extends Controller
{
    /**
     * Inyectamos la INTERFAZ, no la implementación concreta. Laravel resuelve
     * cuál entregar según el binding del AppServiceProvider. El controller no
     * sabe (ni le importa) si es aleatorio o Sqids.
     */
    public function __construct(
        private readonly CodeGenerator $codeGenerator,
    ) {}

    /**
     * GET / — muestra el formulario para crear un link.
     */
    public function create(): View
    {
        return view('links.create');
    }

    /**
     * POST /links — crea el link y vuelve al formulario mostrando el resultado.
     *
     * $request ya viene validado (si la URL era inválida, Laravel ni llega aquí:
     * redirige de vuelta con los errores automáticamente).
     */
    public function store(StoreLinkRequest $request): RedirectResponse
    {
        $link = Link::create([
            'code' => $this->codeGenerator->generate(),
            'destination' => $request->validated('destination'),
        ]);

        // Volvemos al formulario con el link corto recién creado en la sesión
        // (flash). La vista lo mostrará para copiar.
        return redirect()
            ->route('links.create')
            ->with('shortUrl', url('/' . $link->code))
            ->with('destination', $link->destination);
    }

    /**
     * GET /{code} — resuelve un código y redirige al destino.
     *
     * firstOrFail: si el código no existe, devuelve un 404 limpio.
     * Este es el método que irá creciendo en próximas iteraciones.
     */
    public function resolve(string $code): RedirectResponse
    {
        $link = Link::where('code', $code)->firstOrFail();

        // 301 = redirección permanente. Para un acortador es lo habitual
        // (el destino de un código no cambia). Cuando sumemos analítica de
        // clics quizá pasemos a 302 para no cachear y poder contar cada visita.
        return redirect()->away($link->destination, 301);
    }
}
