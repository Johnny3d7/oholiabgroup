<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('factures', function (Blueprint $table) {
            $table->id();
            $table->string('uuid', 100);
            $table->string('reference', 100);
            $table->date('date_emission');
            $table->integer('montant');
            $table->text('file')->nullable();
            $table->text('description')->nullable();

            $table->unsignedBigInteger('id_fournisseurs');
            $table->foreign('id_fournisseurs')->references('id')->on('fournisseurs')->onDelete('cascade');

            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('ligne_factures', function (Blueprint $table) {
            $table->id();

            $table->string('uuid');
            $table->text('observations')->nullable();

            $table->unsignedBigInteger('id_factures');
            $table->foreign('id_factures')->references('id')->on('factures')->onDelete('cascade');
            $table->unsignedBigInteger('id_ligne_besoins');
            $table->foreign('id_ligne_besoins')->references('id')->on('ligne_besoins')->onDelete('cascade');

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
        Schema::dropIfExists('ligne_factures');
        Schema::dropIfExists('factures');
    }
}
