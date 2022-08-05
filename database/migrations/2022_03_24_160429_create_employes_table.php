<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class createEmployesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employes', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->string('uuid',100);
			$table->string('civilite',5)->default('M');
			$table->string('nom',100);
			$table->string('prenoms',100);
			$table->string('contact',100);
			$table->string('email',100);
			$table->date('birthdate')->nullable();
			$table->date('hiredate')->nullable();

            $table->integer("id_entreprises")->unsigned();

            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->integer("id_employes")->unsigned()->nullable();
            $table->foreign('id_employes')->references('id')->on('employes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employes');

        // Schema::table('users', function (Blueprint $table) {
        //     $table->dropForeign('id_employes');
        //     $table->dropColumn('id_employes');
        // });
    }
}
