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
        Schema::create('devices', function (Blueprint $table) {
            $table->id();
            $table->string('mac')->unique();
            $table->string('secret');
            $table->boolean('isPump')->default(0);
            $table->boolean('isManual')->default(0);
            $table->integer('wetLevel');
            $table->dateTime('lastActive')->nullable();
            $table->integer('sensorNumber');
            $table->integer('valveNumber');
            $table->string('sensorValue')->nullable();
            $table->string('valveStatus')->nullable();
            $table->string('rainIntensity')->nullable();
            $table->dateTime('lastUpdate')->nullable();
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
        Schema::dropIfExists('devices');
    }
};
