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
        Schema::create('vehiculo', function (Blueprint $table) {
            $table->string('placa', 7)->primary();
            $table->string('marca', 100);
            $table->string('color', 50);
            $table->decimal('kilometraje', 10, 2);
            $table->string('cliente_dni_ruc', 11); 
            $table->foreign('cliente_dni_ruc')
                ->references('dni_ruc')
                ->on('cliente')
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
        Schema::dropIfExists('vehiculo');
    }
};
