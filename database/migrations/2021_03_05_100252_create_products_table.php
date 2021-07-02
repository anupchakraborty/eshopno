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
            $table->integer('cat_id')->unsigned();
            $table->integer('brand_id')->unsigned();
            $table->string('product_title');
            $table->string('product_slug');
            $table->text('product_description')->nullable();
            $table->integer('quantity')->default(1);
            $table->integer('sell_price');
            $table->integer('buy_price');
            $table->tinyInteger('status')->dafault(0);
            $table->integer('offer_price')->nullable();
            $table->integer('admin_id')->unsigned();
            $table->string('product_color')->nullable();
            $table->string('product_size')->nullable();
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
