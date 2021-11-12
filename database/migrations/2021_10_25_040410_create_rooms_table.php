<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('hotel_id');
            $table->string('room_type');
            $table->string('room_character')->nullable();
            $table->string('room_view')->nullable();
            $table->string('room_name');
            $table->boolean('smoking_policy')->nullable();
            $table->unsignedInteger('total_rooms')->default(1);
            $table->unsignedTinyInteger('adult_occupancy')->default(1);
            $table->unsignedTinyInteger('child_occupancy')->default(0);
            $table->unsignedTinyInteger('extra_bed')->default(0);
            $table->boolean('max_guest_allow')->default(0);
            $table->float('room_size')->nullable();
            $table->decimal('rack_price');
            $table->boolean('status')->default(config('app.status.active'));
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('hotel_id')
                ->references('id')
                ->on('hotels')
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
        Schema::dropIfExists('rooms');
    }
}
