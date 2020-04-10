<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarComponentLevelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('car_component_levels', function (Blueprint $table) {
            $table->id('car_component_level_id');
            $table->unsignedBigInteger('car_component_id');
            $table->unsignedSmallInteger('level');
            $table->unsignedMediumInteger('upgrade_cost');
            $table->unsignedSmallInteger('stat_power');
            $table->unsignedSmallInteger('stat_aero');
            $table->unsignedSmallInteger('stat_grip');
            $table->unsignedSmallInteger('stat_reliability');
            $table->decimal('stat_pit_stop', 5, 2);
            $table->unsignedMediumInteger('required_upgrade_points');
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
        Schema::dropIfExists('car_component_levels');
    }
}
