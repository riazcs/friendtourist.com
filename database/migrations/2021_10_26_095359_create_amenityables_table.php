<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAmenityablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('amenityables', function (Blueprint $table) {
            $table->unsignedBigInteger("amenity_id");
            $table->foreign("amenity_id")->references('id')->on('amenities')->cascadeOnDelete();
            $table->morphs('amenityables');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('amenityables');
    }
}
