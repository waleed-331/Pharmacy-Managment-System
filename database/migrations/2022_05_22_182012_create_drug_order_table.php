<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDrugOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drug_order', function (Blueprint $table) {
            $table->id();
          //  $table->integer('quantity');
            $table->foreignId('order_id')->references('id')->on('orders')->onDelete('cascade');
            $table->foreignId('drug_id')->references('id')->on('drugs')->onDelete('cascade');
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
        Schema::dropIfExists('drug_order');
    }
}
