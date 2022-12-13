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
        Schema::create('airbases', function (Blueprint $table) {
            $table->id();
            $table->string('code_airbase');
            $table->string('name_airbase');
            $table->string('slug')->unique();
            $table->bigInteger('country_id')->unsigned()->nullable();
            $table->integer('fighter_plane')->nullable()->default(0);
            $table->string('leader')->nullable()->default(0);
            $table->integer('soldier')->nullable()->default(0);
            $table->string('image')->nullable();
            $table->longText('description')->nullable();
            $table->string('coordinate')->nullable();
            $table->timestamps();
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('airbases');
    }
};
