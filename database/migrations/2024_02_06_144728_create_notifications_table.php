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
        //modelando o banco de dados para fazer a migraçao
        //criar os atributos da tabela do banco, eles devem ter os mesmos tipos
        
        //atributos:
        //from -> user id
        //to -> user id
        //status -> se rceebeu ou nao a notificaçao
        //message -> id da mensagem enviada entre 'to' e 'from'
        
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('from');
            $table->unsignedBigInteger('to');
            $table->boolean('status');
            $table->unsignedBigInteger('message');
            $table->timestamps();
            
            //chaves estrangeiras
            $table->foreign('from')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('to')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('message')->references('id')->on('messages')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
