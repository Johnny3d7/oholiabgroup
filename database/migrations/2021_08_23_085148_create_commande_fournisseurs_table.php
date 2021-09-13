<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommandeFournisseursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commande_fournisseurs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('num_cmd')->nullable();
            $table->string('slug');
            $table->string('lieu_livraison');
            $table->string('mode_reglement');
            $table->string('type_commande');
            $table->string('id_user');
            $table->string('id_entreprise');
            $table->string('observation');
            $table->integer('status')->default(0);
            $table->timestamps();

            //Foreign_key
            $table->integer('id_fournisseur')->unsigned();
            $table->integer('id_boncommande')->unsigned()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('commande_fournisseurs');
    }
}
