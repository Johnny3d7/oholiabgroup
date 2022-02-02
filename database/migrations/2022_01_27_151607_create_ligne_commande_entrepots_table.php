<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLigneCommandeEntrepotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ligne_commande_entrepots', function (Blueprint $table) {
            $table->id();
            $table->integer('id_ligne_commande')->unsigned();
            $table->integer('id_entrepot')->unsigned();
            
            $table->foreign('id_ligne_commande')->references('id')->on('ligne_commandes')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('id_entrepot')->references('id')->on('entrepots')
                ->onDelete('cascade')
                ->onUpdate('cascade');

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
        Schema::table('ligne_commande_entrepots', function (Blueprint $table) {
            $table->dropForeign('ligne_commande_entrepots_id_ligne_commande_foreign');
            $table->dropForeign('ligne_commande_entrepots_id_entrepot_foreign');
        });

        Schema::dropIfExists('ligne_commande_entrepots');
    }
}
