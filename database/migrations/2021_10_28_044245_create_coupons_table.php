<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('host_id')->nullable();
            $table->string('coupon_code');
            $table->decimal('coupon_value');
            $table->decimal('max_limit')->nullable();
            $table->boolean('discount_type');
            $table->boolean('status')->default(0);
            $table->dateTime('start_date');
            $table->dateTime('end_date');
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
        Schema::dropIfExists('coupons');
    }
}
