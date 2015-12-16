<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('title');
            $table->text('abstract');
            $table->text('content');
            $table->integer('price')->default(0);
            $table->boolean('status')->default(false);
            $table->dateTime('published_at');
            $table->timestamps();

            $table->integer('image_id')->unsigned()->nullable();
            $table->foreign('image_id')->references('id')->on('images')->onDelete('SET NULL'); // dans le cas ou une image sera suprimmer, le poste le sera pas

            $table->integer('category_id')->unsigned()->nullable();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('products');
    }
}
