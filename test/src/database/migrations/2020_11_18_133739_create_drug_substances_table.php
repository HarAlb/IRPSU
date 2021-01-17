<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDrugSubstancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drug_substance', function (Blueprint $table) {
            $table->unsignedBigInteger('drug_id')->unsigned();
            $table->unsignedBigInteger('substance_id')->unsigned();

            $table->unique(['drug_id', 'substance_id']);
            $table->foreign('drug_id')->references('id')->on('drugs')->onDelete('cascade');
            $table->foreign('substance_id')->references('id')->on('substances')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('drug_substance');
    }
}
