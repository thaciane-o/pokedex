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
        Schema::create('imagem', function (Blueprint $table) {
            $table->id();
            $table->string('caminho');
            $table->foreignId('chat_id')->nullable()->references('id')->on('chat');
            $table->foreignId('mensagem_id')->nullable()->references('id')->on('mensagem');
            $table->foreignId('cliente_id')->nullable()->references('id')->on('cliente');
            $table->foreignId('user_id')->nullable()->references('id')->on('users');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('imagem');
    }
};
