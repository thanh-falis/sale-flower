<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id', 11);
            $table->string('name', 100)->unique();
            $table->integer('id_type', 11);
            $table->string('descripttion');
            $table->float('unit_price');
            $table->float('promotion_price');
            $table->string('image', 255);
            $table->string('unit', 255);
            $table->integer('new', 5);
            $table->tinyInt('flag', 1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
