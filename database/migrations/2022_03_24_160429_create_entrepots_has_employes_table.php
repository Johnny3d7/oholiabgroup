<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class createEntrepotsHasEmployesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entrepots_has_employes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('uuid',100)->nullable();
			$table->string('type',100)->nullable();

			$table->unsignedBigInteger('id_entrepots')->nullable();
			$table->unsignedBigInteger('id_employes')->nullable();
            // $table->foreign('id_entrepots')->references('id')->on('entrepots')->onDelete('cascade');
            // $table->foreign('id_employes')->references('id')->on('employes')->onDelete('cascade');

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
        Schema::dropIfExists('entrepots_has_employes');
    }
}
