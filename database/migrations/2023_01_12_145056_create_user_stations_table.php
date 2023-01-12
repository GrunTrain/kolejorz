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
        Schema::create('user_stations', function (Blueprint $table) {
            $table->integer("user_id");
            $table->integer("station_id");
            $table->primary(["user_id", "station_id"]);
            $table->integer("times_visited");
            $table->integer("times_passed");
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
        Schema::dropIfExists('user_stations');
    }
};
