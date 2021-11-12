<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookedRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booked_rooms', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('booking_id');
            $table->unsignedBigInteger('room_id');
            $table->unsignedBigInteger('schedule_id');
            $table->decimal('rack_price');
            $table->decimal('bar_price');
            $table->string('room_name');
            $table->unsignedTinyInteger('room_qty');
            $table->longText('room_amenities')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('booking_id')
                ->references('id')
                ->on('bookings')
                ->cascadeOnDelete();

            $table->foreign('room_id')
                ->references('id')
                ->on('rooms')
                ->cascadeOnDelete();

            $table->foreign('schedule_id')
                ->references('id')
                ->on('room_schedules')
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
        Schema::dropIfExists('booked_rooms');
    }
}
