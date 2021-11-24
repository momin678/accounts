<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMakeOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('make_orders', function (Blueprint $table) {
            $table->id();
            $table->string('project_id');
            $table->string('supplier_id');
            $table->date('date');
            $table->string('invoice_number');
            $table->mediumText('name');
            $table->mediumText('quantity');
            $table->string('status')->default(0);
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
        Schema::dropIfExists('make_orders');
    }
}
