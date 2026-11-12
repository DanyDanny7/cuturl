<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Valida la entrada al crear un link.
 *
 * Un Form Request aísla TODA la validación fuera del controller. El controller
 * solo recibe datos ya validados — no tiene que preguntarse si la URL es válida.
 *
 * Este es nuestro punto de cambio #2: hoy las reglas son básicas; en la
 * Iteración 3 le sumaremos una regla `SafeUrl` (solo http/https, bloquear IPs
 * internas para evitar SSRF/phishing) y solo tocaremos este archivo.
 */
class StoreLinkRequest extends FormRequest
{
    /**
     * ¿Está autorizado a hacer esta petición? Por ahora el acortador es
     * público (cualquiera puede crear un link), así que devolvemos true.
     * Cuando haya usuarios/login, aquí se decide el permiso.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Las reglas de validación.
     *
     * @return array<string, array<int, string>>
     */
    public function rules(): array
    {
        return [
            'destination' => [
                'required',
                'string',
                'url:http,https', // debe ser una URL http o https bien formada
                'max:2048',       // límite sano para una URL
            ],
        ];
    }

    /**
     * Mensajes en español para que el usuario entienda el error.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'destination.required' => 'Pega una URL para acortar.',
            'destination.url' => 'Eso no parece una URL válida (debe empezar con http:// o https://).',
            'destination.max' => 'La URL es demasiado larga.',
        ];
    }
}
