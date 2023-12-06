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
        Schema::create('pets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('race_id'); //Nome da coluna race_id e que não pode numeros negativos
            $table->unsignedBigInteger('specie_id'); //Nome da coluna
            $table->string('name', 150);
            $table->integer('age')->nullable(); //Pode ser nulo
            $table->float('weight')->nullable();
            $table->enum('size', ['SMALL', 'MEDIUM', 'LARGE', 'EXTRA_LARGE']);
            $table->timestamps();

            //Quero que a coluna race_id se referencie pelo id da tabela races
            $table->foreign('race_id')->references('id')->on('races'); //Fazendo o relacionamento
            $table->foreign('specie_id')->references('id')->on('species'); //Fazendo o relacionamento
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pets');
    }
};
