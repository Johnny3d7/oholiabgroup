<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLivraisonTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('livraisons', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug')->nullable();
            $table->string('nom_livreur');
            $table->string('numero_vehicule')->nullable();
            $table->string('date_reception')->nullable();
            $table->integer('status')->default(0);
            $table->timestamps();

            //Foreign_key
            $table->integer('id_commande')->unsigned()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('livraisons');
    }
}
