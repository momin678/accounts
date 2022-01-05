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
            $table->string('name');
            $table->tinyInteger('category_id');
            $table->tinyInteger('brand_id')->nullable();
            $table->string('photos');
            $table->double('price', 8, 2);
            $table->string('quintity');
            $table->string('tags')->nullable();
            $table->mediumText('specification')->nullable();
            $table->tinyInteger('featured')->default('0');
            $table->tinyInteger('status')->default(1);
            $table->string('slug');
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
