<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    /**
     * Campos que se pueden asignar de forma masiva (Link::create([...])).
     *
     * En Laravel, por seguridad, un campo NO se puede llenar desde un array
     * de entrada a menos que esté en $fillable. Esto evita el "mass assignment":
     * que alguien mande un campo extra en el formulario (p. ej. is_admin) y
     * termine guardándose sin querer. Solo listamos lo que el usuario sí
     * controla al crear un link.
     */
    protected $fillable = [
        'code',
        'destination',
    ];
}
