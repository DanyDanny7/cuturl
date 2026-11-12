<?php

namespace App\Services\CodeGenerator;

use App\Models\Link;
use Illuminate\Support\Str;

/**
 * Implementación del MVP: un código aleatorio corto.
 *
 * Cumple el contrato CodeGenerator. Genera una cadena aleatoria y se asegura
 * de que NO exista ya en la base de datos antes de devolverla (si hubiera
 * colisión, prueba otra). Así garantizamos la unicidad que la columna
 * `code` exige.
 *
 * Nota de diseño: esto es deliberadamente simple. Un código aleatorio YA es
 * difícil de adivinar, pero la garantía fuerte de "no enumerable" llegará con
 * Sqids en la Iteración 2 — y como todo vive detrás de la interfaz, cambiarlo
 * no tocará ni el controller ni el service.
 */
class RandomCodeGenerator implements CodeGenerator
{
    /**
     * Largo del código. 6 caracteres alfanuméricos dan miles de millones de
     * combinaciones: suficiente para un proyecto de aprendizaje y cómodo de leer.
     */
    private const LENGTH = 6;

    public function generate(): string
    {
        // Str::random puede traer caracteres ambiguos; usamos un alfabeto
        // controlado (sin 0/O/l/I) para que los códigos sean fáciles de leer
        // y de dictar en voz alta.
        do {
            $code = $this->randomString(self::LENGTH);
        } while (Link::where('code', $code)->exists());

        return $code;
    }

    private function randomString(int $length): string
    {
        $alphabet = '23456789abcdefghijkmnpqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ';
        $max = strlen($alphabet) - 1;

        $code = '';
        for ($i = 0; $i < $length; $i++) {
            // random_int es criptográficamente seguro (mejor que rand()).
            $code .= $alphabet[random_int(0, $max)];
        }

        return $code;
    }
}
