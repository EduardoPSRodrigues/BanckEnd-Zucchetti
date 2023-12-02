<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private $table = 'pets';
    private $collumn = 'race_id';
    private $foreign = 'pets_race_id_foreign';

    public function up(): void
    {
        //A tabela já tem que existir para eu adicionar as colunas, essa é a diferença entre o table e o create
        Schema::table($this->table, function (Blueprint $table) {
            //after('id') significa que será criado essa coluna depois do id e não no final da tabela
            $table->bigInteger($this->collumn)->after('id');

            //Chave estrangeira que fará referencia ao id na tabela races
            //$table->foreign(race_id)->references('id')->on('races');
            $table->foreign($this->collumn)->references('id')->on('races');
        });
    }

    public function down(): void
    {
        Schema::table($this->table, function (Blueprint $table) {
            //Sempre quando criar uma ação no up, faz o reverso no down
            $table->dropForeign($this->foreign);
            $table->dropColumn($this->collumn);
        });
    }
};
