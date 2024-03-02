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
        Schema::create('solicitations_documents', function (Blueprint $table) {
            $table->uuid('id'); //cria um id camuflado com hash
            $table->unsignedBigInteger('client_id');
            $table->foreign('client_id')->references('id')->on('clients'); //faz referencia com o id do cliente

            $table->unsignedBigInteger('cpf')->nullable();
            $table->foreign('cpf')->references('id')->on('files'); //faz referencia a tabela com a imagem do arquivo

            $table->unsignedBigInteger('rg')->nullable();
            $table->foreign('rg')->references('id')->on('files'); //faz referencia a tabela com a imagem do arquivo

            $table->unsignedBigInteger('document_address')->nullable();
            $table->foreign('document_address')->references('id')->on('files'); //faz referencia a tabela com a imagem do arquivo

            $table->unsignedBigInteger('term_adoption')->nullable();
            $table->foreign('term_adoption')->references('id')->on('files'); //faz referencia a tabela com a imagem do arquivo

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('solicitations_documents');
    }
};
