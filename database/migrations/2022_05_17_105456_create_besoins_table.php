<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBesoinsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('besoins', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string("uuid",100);
            $table->string("nature",100);
            $table->date("date_emission");
            $table->date("date_livraison");
            $table->string("statut",100);
            $table->string("employe",100);
            $table->text("observations")->nullable();

            $table->unsignedBigInteger("id_entreprises")->nullable();
            $table->foreign('id_entreprises')->references('id')->on('entreprises')->onDelete('cascade');
            
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('ligne_besoins', function (Blueprint $table) {
            $table->id();

            $table->string("uuid",100);
			$table->string("article",100);
			$table->string("quantite",100);
			$table->string("prix",100);
			$table->text("observations")->nullable();

			$table->unsignedBigInteger("id_besoins")->nullable();
            $table->foreign('id_besoins')->references('id')->on('besoins')->onDelete('cascade');

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
        Schema::dropIfExists('ligne_besoins');
        Schema::dropIfExists('besoins');
    }
}
