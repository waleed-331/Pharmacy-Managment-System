<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drugs', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('company');
            $table->string('body_system');
            $table->integer('price');
            $table->date('expiration_date');
            $table->integer('quantity');
            $table->string('form');
            $table->float('dose');
            $table->integer('price_for_public');
            $table->string('place');
            $table->boolean('prescription')->default(false);
            $table->string('scientific_name');
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
        Schema::dropIfExists('drugs');
    }
};
