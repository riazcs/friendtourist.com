<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('hotel_id');
            $table->unsignedInteger('total_room');
            $table->unsignedInteger('adult');
            $table->unsignedInteger('child');
            $table->date('check_in');
            $table->date('check_out');
            $table->decimal('rack_total');
            $table->decimal('hotel_discount')->nullable();
            $table->decimal('sub_total');
            $table->decimal('total_charge');
            $table->unsignedBigInteger('coupon_id')->nullable();
            $table->decimal('coupon_discount')->nullable()->default(0);
            $table->decimal('convenience_fee');
            $table->decimal('total_amount');
            $table->decimal('total_save');
            $table->string('transaction_id');
            $table->string('currency');
            $table->boolean('status');
            $table->boolean('payment_status');
            $table->string('payment_method')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->cascadeOnDelete();

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
        Schema::dropIfExists('bookings');
    }
}
