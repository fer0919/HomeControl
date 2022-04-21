<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeedGruopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feed_gruops', function (Blueprint $table) {
            $table->id();
            $table->string('id_grupo');
            $table->string('value');
            $table->unsignedBigInteger('feed_temperatura_fk');
            $table->foreign('feed_temperatura_fk')->references('id')->on('feed_temperatura');
            $table->unsignedBigInteger('feed_humedad_fk');
            $table->foreign('feed_humedad_fk')->references('id')->on('feed_humedad');
            $table->unsignedBigInteger('feed_ultrasonido_fk');
            $table->foreign('feed_ultrasonido_fk')->references('id')->on('feed_ultrasonido');
            $table->unsignedBigInteger('feed_servomotor_fk');
            $table->foreign('feed_servomotor_fk')->references('id')->on('feed_servomotor');
            $table->unsignedBigInteger('feed_luminosidad_fk');
            $table->foreign('feed_luminosidad_fk')->references('id')->on('feed_luminosidad');
            $table->unsignedBigInteger('feed_humo_fk');
            $table->foreign('feed_humo_fk')->references('id')->on('feed_humo');
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
        Schema::dropIfExists('feed_gruops');
    }
}
