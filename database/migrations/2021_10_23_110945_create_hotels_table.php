<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHotelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hotels', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('district_id')->nullable();
            $table->string('property_type')->nullable();
            $table->string('no_of_rooms')->nullable();
            $table->string('no_of_floors')->nullable();
            $table->text('description')->nullable();
            $table->string('construction_year')->nullable();
            $table->string('license')->nullable();
            $table->string('website')->nullable();
            $table->boolean('no_of_star')->nullable();
            $table->string('contact_first_name')->nullable();
            $table->string('contact_last_name')->nullable();
            $table->string('contact_email')->nullable();
            $table->string('contact_phone')->nullable();
            $table->string('contact_designation')->nullable();
            $table->string('contact_department_name')->nullable();
            $table->text('address_line')->nullable();
            $table->string('area')->nullable();
            $table->string('lon')->nullable();
            $table->string('lat')->nullable();
            $table->text('rules')->nullable();
            $table->time('check_in_from')->nullable();
            $table->time('check_in_to')->nullable();
            $table->time('check_out_from')->nullable();
            $table->time('check_out_to')->nullable();
            $table->boolean('child_policy')->nullable();
            $table->boolean('pet_policy')->nullable();
            $table->boolean('min_age_child')->nullable();
            $table->double('service_charge')->nullable();
            $table->double('extra_bed_charge')->nullable();
            $table->boolean('status')->nullable();
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
        Schema::dropIfExists('hotels');
    }
}
