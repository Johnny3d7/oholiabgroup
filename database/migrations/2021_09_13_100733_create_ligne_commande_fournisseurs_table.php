<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLigneCommandeFournisseursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ligne_commande_fournisseurs', function (Blueprint $table) {

            $table->integer('commande_fournisseur_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->integer('qte');
            $table->integer('prix');
            $table->integer('status')->default(1);
            
            $table->foreign('commande_fournisseur_id')->references('id')->on('commande_fournisseurs')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('product_id')->references('id')->on('products')
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
        Schema::table('ligne_commande_fournisseurs', function (Blueprint $table) {
            $table->dropForeign('ligne_commande_fournisseurs_commande_fournisseur_id_foreign');
            $table->dropForeign('ligne_commande_fournisseurs_product_id_foreign');
        });

        Schema::dropIfExists('ligne_commande_fournisseurs');
    }
}
