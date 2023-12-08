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
        Schema::create('vehiculos', function (Blueprint $table) {
            $table->string('placa', 7)->primary(); // Define 'placa' como clave primaria
            $table->string('marca', 100);
            $table->string('color', 50);
            $table->decimal('kilometraje', 10, 2);
            $table->string('cliente_dniruc'); // Columna para la clave foránea
            $table->foreign('cliente_dniruc')
                ->references('dniruc')
                ->on('clientes')
                ->onUpdate('cascade')
                ->onDelete('restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehiculos');
    }
};
