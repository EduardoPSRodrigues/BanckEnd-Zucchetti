<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * https://cdn.cloudflare.steamstatic.com/steamcommunity/public/images/apps/271590/3cbdd1df8fa8e0d6722dc7d169ab1d5226e1b06a.jpg
     */
    public function up(): void
    {
        Schema::create('achievements', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('product_id');
            $table->string('url');
            $table->string('name');
            $table->string('description')->nullable();
            $table->timestamps();

            //Fazer a referencia da chave estrangeira (->onDelete('cascade') caso queira fazer deleção em cascata)
            $table->foreign('product_id')->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('achievements');
    }
};
