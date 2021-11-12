<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMinimumOrderValueToCoupons extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('coupons', function (Blueprint $table) {
            $table->decimal('minimum_order_value')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('coupons', function (Blueprint $table) {
            $table->dropColumn(['minimum_order_value']);
        });
    }
}
