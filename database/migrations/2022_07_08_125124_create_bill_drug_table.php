<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillDrugTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bill_drug', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bill_id')->references('id')->on('bills')->onDelete('cascade');
            $table->foreignId('drug_id')->references('id')->on('drugs')->onDelete('cascade');
            $table->integer('quantity');
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
        Schema::dropIfExists('bill_drug');
    }
}
