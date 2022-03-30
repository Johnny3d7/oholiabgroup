<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class createLigneMouvementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ligne_mouvement', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('uuid',100)->nullable();
			$table->decimal('quantite')->nullable();

			$table->unsignedBigInteger('id_products')->nullable();
			$table->unsignedBigInteger('id_entrepots')->nullable();
			$table->unsignedBigInteger('id_mouvements')->nullable();
            $table->foreign('id_products')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('id_entrepots')->references('id')->on('entrepots')->onDelete('cascade');
            $table->foreign('id_mouvements')->references('id')->on('mouvements')->onDelete('cascade');

            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ligne_mouvement');
    }
}
