<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNotSoldRoomSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('room_schedules', function (Blueprint $table) {
            $table->unsignedTinyInteger('not_sold')->default(0)->after('available_room');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('room_schedules', function (Blueprint $table) {
            $table->dropColumn(['not_sold']);
        });
    }
}
