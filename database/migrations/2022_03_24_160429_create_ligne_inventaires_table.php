<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class createLigneInventairesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ligne_inventaires', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('uuid',100);
			$table->string('statut',100);
			$table->decimal('qte_att',10,0);
			$table->decimal('qte_res',10,0);
			$table->text('observations')->nullable();

			$table->unsignedBigInteger('id_products')->nullable();
			$table->unsignedBigInteger('id_inventaires')->nullable();
			$table->unsignedBigInteger('id_entrepots')->nullable();
            $table->foreign('id_products')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('id_inventaires')->references('id')->on('inventaires')->onDelete('cascade');
            $table->foreign('id_entrepots')->references('id')->on('entrepots')->onDelete('cascade');

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
        Schema::dropIfExists('ligne_inventaires');
    }
}
