<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRatingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ratings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('hotel_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('booking_id');
            $table->float('hotel_rating')->nullable();
            $table->float('staff_rating')->nullable();
            $table->float('facility_rating')->nullable();
            $table->float('cleanliness_rating')->nullable();
            $table->float('comfort_rating')->nullable();
            $table->float('price_rating')->nullable();
            $table->float('location_rating')->nullable();
            $table->longText('review')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('ratings');
    }
}
