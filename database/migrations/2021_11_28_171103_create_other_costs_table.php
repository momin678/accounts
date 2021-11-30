<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOtherCostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('other_costs', function (Blueprint $table) {
            $table->id();
            $table->string('project_id');
            $table->date('date');
            $table->string('invoice_number');
            $table->string('name');
            $table->string('quantity');
            $table->string('amount');
            $table->string('document')->nullable();
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
        Schema::dropIfExists('other_costs');
    }
}
