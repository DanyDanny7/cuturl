<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('links', function (Blueprint $table) {
            $table->id();

            // El código corto que aparece en la URL (p. ej. "x7Gq2").
            // unique() garantiza que no haya dos links con el mismo código
            // y, de paso, crea un índice que hace instantánea la búsqueda
            // en la ruta GET /{code}.
            $table->string('code')->unique();

            // La URL de destino a la que redirigimos. text() porque las URLs
            // pueden ser largas (parámetros, tokens, etc.).
            $table->text('destination');

            $table->timestamps();

            // Columnas futuras (expires_at, max_clicks, password_hash,
            // click_count...) NO van aquí: entrarán con su propia migración
            // cuando implementemos cada feature. Eso es usar migraciones
            // de verdad en lugar de adivinar el esquema desde el día uno.
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('links');
    }
};
