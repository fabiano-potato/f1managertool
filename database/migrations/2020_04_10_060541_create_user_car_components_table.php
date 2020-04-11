<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserCarComponentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_car_components', function (Blueprint $table) {
            $table->id('user_car_components_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('car_component_id');
            $table->unsignedInteger('current_upgrade_points');
            $table->unsignedSmallInteger('current_level');
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
        Schema::dropIfExists('user_car_components');
    }
}
