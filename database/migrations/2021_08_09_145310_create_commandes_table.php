<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommandesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commandes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('num_cmd')->nullable();
            $table->string('slug');
            $table->string('lieu_livraison');
            $table->string('date_livraison');
            $table->string('mode_reglement');
            $table->string('canal_reception');
            $table->string('create_facture')->default(0);
            $table->string('create_bonlivraison')->default(0);
            $table->string('type');
            $table->integer('status')->default(0);
            $table->timestamps();
            //Foreign_key
            $table->integer('id_client')->unsigned()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('commandes');
    }
}
