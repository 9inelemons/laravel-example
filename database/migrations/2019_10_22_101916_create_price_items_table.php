<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePriceItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('price_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('price_id')->unsigned();
            $table->string('code');
            $table->string('name');
            $table->string('measure');
            $table->float('price', 10, 2);
            $table->timestamps();
            $table->uuid('uuid');
            $table->softDeletes();

            $table->foreign('price_id')->references('id')->on('prices')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('price_items');
    }
}
