<?php

namespace App\Services\CodeGenerator;

/**
 * El "contrato" de cómo se genera un código corto.
 *
 * Esto es una INTERFAZ: no dice CÓMO se genera el código, solo QUE existe
 * una forma de generarlo. El resto de la app (el controller, el service)
 * dependerá de esta interfaz, nunca de una implementación concreta.
 *
 * ¿Por qué? Porque "cómo se genera el código" es nuestro punto de cambio #1.
 * Hoy usamos una implementación aleatoria simple (RandomCodeGenerator).
 * Mañana, para códigos no enumerables, cambiaremos a una implementación con
 * Sqids — y bastará con cambiar UNA línea en el AppServiceProvider. Ningún
 * otro archivo se entera. Eso es "escalar sin reescribir".
 */
interface CodeGenerator
{
    /**
     * Devuelve un código corto único listo para usar en la URL.
     */
    public function generate(): string;
}
