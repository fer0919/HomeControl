<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class GruposUsuarios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grupos_usuarios', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('fk_usuario');
            $table->unsignedBigInteger('fk_grupo');
            $table->foreign('fk_usuario')->references('id')->on('users');
            $table->foreign('fk_grupo')->references('id')->on('grupos');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
