<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class createEntrepotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entrepots', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->string('uuid',100);
			$table->string('reference',100)->nullable();
			$table->string('name',100);
			$table->string('lieu',100)->nullable();

			$table->unsignedBigInteger('id_entreprises')->nullable();
            $table->foreign('id_entreprises')->references('id')->on('entreprises')->onDelete('cascade');
            
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
        Schema::dropIfExists('entrepots');
    }
}
