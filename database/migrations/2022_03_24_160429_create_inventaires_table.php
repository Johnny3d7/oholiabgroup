<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class createInventairesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventaires', function (Blueprint $table) {
            $table->bigIncrements("id");
			$table->string("uuid",100);
			$table->string("name",100);
			$table->dateTime("date_inventaire");
			$table->string("statut",100)->nullable();
            $table->text("observations")->nullable();

            $table->unsignedBigInteger('id_entreprises')->nullable();
            $table->foreign('id_entreprises')->references('id')->on('entreprises')->onDelete('cascade');
            $table->unsignedBigInteger('id_entrepots')->nullable();
            $table->foreign('id_entrepots')->references('id')->on('entrepots')->onDelete('cascade');

			$table->bigInteger("vs_inventoriste")->default(0);
			$table->bigInteger("vs_comptable")->default(0);
			$table->bigInteger("vs_chef_comptable")->default(0);

            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('ligne_inventaires', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('uuid',100);
			$table->string('statut',100);
			$table->decimal('qte_att',10,0);
			$table->decimal('qte_res',10,0);
			$table->text('observations')->nullable();

			$table->unsignedBigInteger('id_products')->nullable();
			$table->unsignedBigInteger('id_inventaires')->nullable();
            $table->foreign('id_products')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('id_inventaires')->references('id')->on('inventaires')->onDelete('cascade');

            $table->unique(['id_products', 'id_inventaires'], 'prod_inventaire');

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
        Schema::dropIfExists('inventaires');
    }
}
