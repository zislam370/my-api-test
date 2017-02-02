<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('add_products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug');
            $table->string('featured_images');
            $table->string('other_image[]');
            $table->integer('status');
            $table->integer('stock');
            $table->decimal('price');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('add_products');
    }
}
