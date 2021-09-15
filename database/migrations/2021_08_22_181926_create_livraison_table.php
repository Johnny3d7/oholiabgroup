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
            $table->string('num_bl');
            $table->string('date_reception_livreur')->nullable();
            $table->string('date_reception_client')->nullable();
            $table->integer('status')->default(1);
            $table->timestamps();

            //Foreign_key
            $table->integer('id_entreprise')->unsigned()->nullable();
            $table->integer('id_commande')->unsigned()->nullable();
            $table->integer('id_livreur')->unsigned()->nullable();
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
