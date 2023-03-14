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
        Schema::create('pipelines', function (Blueprint $table) {
            $table->id();
            $table->text('name_pipeline');
            $table->text('debut_souhaite')->nullable();
            $table->text('taille_moyenne_message')->nullable();
            $table->text('retention_kafka')->nullable();
            $table->boolean('is_running')->nullable();
            $table->foreignId("departement_id");
            $table->foreignId("hopital_id");
            $table->foreignId('user_id')->nullable();
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
        Schema::dropIfExists('pipelines');
    }
};
