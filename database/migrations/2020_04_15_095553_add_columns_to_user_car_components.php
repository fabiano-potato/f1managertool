<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToUserCarComponents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_car_components', function (Blueprint $table) {
            $table->unsignedSmallInteger('car_component_type');
            $table->unsignedInteger('current_upgrade_points')->default(0)->change();
            $table->boolean('is_assigned')->default(false);
            $table->unique(['user_id', 'car_component_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_car_components', function (Blueprint $table) {
            $table->dropColumn('car_component_type');
            $table->unsignedInteger('current_upgrade_points')->default(null)->change();
            $table->dropColumn('is_assigned');
            $table->dropUnique(['user_id', 'car_component_id']);
        });
    }
}
