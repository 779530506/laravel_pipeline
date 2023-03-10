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
        Schema::create('predictions', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('thickness');
            $table->integer('bnuc');
            $table->integer('bchrom');
            $table->integer('nNuc');
            $table->integer('mit');
            $table->integer('size');
            $table->integer('shape');
            $table->integer('madh');
            $table->integer('epsize');
            $table->integer('result')->default(0);
            $table->foreignId("pipeline_id");
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
        Schema::dropIfExists('predictions');
    }
};
