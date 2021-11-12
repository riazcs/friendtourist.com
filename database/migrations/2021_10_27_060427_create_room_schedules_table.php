<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('room_schedules', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('room_id');
            $table->date('start_date');
            $table->date('end_date');
            $table->boolean('board_type')->default(\App\Models\RoomSchedule::BoardType['None']);
            $table->boolean('refundable')->default(\App\Models\RoomSchedule::Refundable['No']);
            $table->boolean('status')->default(\App\Models\RoomSchedule::Status['Close']);
            $table->unsignedTinyInteger('available_room')->default(0);
            $table->decimal('bar_rate');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('room_id')
                ->references('id')
                ->on('rooms')
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('room_schedules');
    }
}
