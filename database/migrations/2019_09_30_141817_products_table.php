<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ProductsTable extends Migration
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

            $table->string('name','255');
            $table->text('description')->nullable();
            $table->integer('product_category_id')->nullable();
            $table->integer('product_brand_id')->nullable();
            $table->string('unit','255')->nullable();
            $table->float('unit_price')->nullable();
            $table->float('purchase_price')->nullable();
            $table->boolean('freeshipping')->default(0);

            $table->integer('client_id')->nullable();

            $table-> unsignedBigInteger('created_by')->nullable();
            $table-> unsignedBigInteger('updated_by')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('product_category', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name','255');
            $table->text('description')->nullable();

            $table-> unsignedBigInteger('created_by')->nullable();
            $table-> unsignedBigInteger('updated_by')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });


        Schema::create('product_brand', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name','255');
            $table->text('description')->nullable();

            $table-> unsignedBigInteger('created_by')->nullable();
            $table-> unsignedBigInteger('updated_by')->nullable();
            $table->softDeletes();
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
        Schema::drop('clients');
        Schema::drop('product_category');
        Schema::drop('product_brand');
    }
}
