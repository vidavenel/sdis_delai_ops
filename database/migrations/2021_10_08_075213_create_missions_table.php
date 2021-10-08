<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('missions', function (Blueprint $table) {
            $table->id();

            $table->string('libelle')->unique();
            $table->text('description')->nullable();

            $table->timestamps();
        });

        Schema::create('engin_mission', function (Blueprint $table) {
            $table->id();

            $table->foreignId('engin_id');
            $table->foreignId('mission_id');

            $table->foreign('engin_id')->references('id')->on('engins');
            $table->foreign('mission_id')->references('id')->on('missions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('engins_missions');
        Schema::dropIfExists('missions');
    }
}
