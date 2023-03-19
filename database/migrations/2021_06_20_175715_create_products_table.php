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
            $table->id();
            $table->string('productname');
            $table->string('slug');
            $table->string('catids')->nullable();
            $table->string('shortdescription')->nullable();
            $table->string('productsku')->nullable();
            $table->string('productqty')->nullable();
            $table->string('price');
            $table->string('discountprice')->nullable();
            $table->string('rplist')->nullable();
            $table->string('longdescription')->nullable();
            $table->string('productimage')->nullable();
            $table->boolean('status');
            $table->string('applications')->nullable();
            $table->integer('vendorid')->nullable();
            $table->string('order')->nullable();
            $table->string('producttags')->nullable();
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
