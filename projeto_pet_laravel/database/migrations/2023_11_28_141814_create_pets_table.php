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
            $table->string('name', 150); //se não passar nada já vem not null
            $table->integer('age')->nullable(); //pode ser vazio
            $table->float('weight')->nullable();
            $table->enum('size', ['SMALL', 'MEDIUM', 'LARGE', 'EXTRA_LARGE']);
            $table->timestamps();
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
