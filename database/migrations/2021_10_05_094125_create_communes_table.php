<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommunesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('communes', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->timestamps();
        });

        Schema::create('centre_commune', function (Blueprint $table) {
            $table->id();

            $table->foreignId('commune_id');
            $table->foreignId('centre_id');

            $table->foreign('commune_id')->references('id')->on('communes');
            $table->foreign('centre_id')->references('id')->on('centres');

            $table->integer('delai')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('centre_commune');
        Schema::dropIfExists('communes');
    }
}
