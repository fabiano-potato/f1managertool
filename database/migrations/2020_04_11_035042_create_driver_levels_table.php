<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDriverLevelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('driver_levels', function (Blueprint $table) {
            $table->id('driver_level_id');
            $table->unsignedBigInteger('driver_id');
            $table->unsignedSmallInteger('level');
            $table->unsignedSmallInteger('stat_overtaking');
            $table->unsignedSmallInteger('stat_defending');
            $table->unsignedSmallInteger('stat_consistency');
            $table->unsignedSmallInteger('stat_fuel_management');
            $table->unsignedSmallInteger('stat_tyre_management');
            $table->unsignedSmallInteger('stat_wet_weather');
            $table->unsignedMediumInteger('upgrade_points');
            $table->unsignedMediumInteger('upgrade_cost');
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
        Schema::dropIfExists('driver_levels');
    }
}
