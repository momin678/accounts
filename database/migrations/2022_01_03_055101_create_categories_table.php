<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->tinyInteger('parent_id')->default('0');
            $table->tinyInteger('level')->default('0');
            $table->tinyInteger('order_level')->default('0');
            $table->double('commission_rate',8,2)->nullable(false)->default('0.00');
            $table->string('banner')->nullable();
            $table->string('icon')->nullable();
            $table->string('slug');
            $table->string('meta_title')->nullable();
            $table->mediumText('meta_description')->nullable();
            $table->tinyInteger('top')->default('0');
            $table->tinyInteger('featured')->default('0');
            $table->tinyInteger('status')->default(1);
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
        Schema::dropIfExists('categories');
    }
}
