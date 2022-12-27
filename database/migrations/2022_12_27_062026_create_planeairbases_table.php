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
        Schema::create('planeairbases', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('plane_id');
            $table->unsignedBigInteger('airbase_id');
            $table->longText('description')->nullable();
            $table->tinyInteger('sum');
            $table->timestamps();

            $table->foreign('plane_id')->references('id')->on('planes');
            $table->foreign('airbase_id')->references('id')->on('airbases');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('planeairbases');
    }
};
