<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    //Alterar a tabela pets para adicionar um campo de client_id
    public function up(): void
    {
        Schema::table('pets', function  (Blueprint $table) {
            //Como a tabela ja tem dados, eu preciso colocar aqui nullable, mas na hora de cadastrar o pet
            //eu tenho que garantir que o campo será preenchido
            $table->unsignedBigInteger('client_id')->nullable();
            $table->foreign('client_id')->references('id')->on('clients');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pets', function (Blueprint $table) {
            $table->dropColumn('client_id');
        });
    }
};
