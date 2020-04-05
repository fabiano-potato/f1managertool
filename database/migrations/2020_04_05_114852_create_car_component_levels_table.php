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
            $table->bigInteger('car_component_id');
            $table->smallInteger('level');
            $table->integer('upgrade_cost');
            $table->smallInteger('stat_power');
            $table->smallInteger('stat_aero');
            $table->smallInteger('stat_grip');
            $table->smallInteger('stat_reliability');
            $table->decimal('stat_pit_stop', 5, 2);
            $table->smallInteger('required_upgrade_points');
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
