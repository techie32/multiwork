<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking', function (Blueprint $table) {
            $table->id();
            $table->integer('zip_code');
            $table->string('service_type');
            $table->integer('model');
            $table->string('device_issue_name');
            $table->string('device_issue_description');
            $table->string('screen_color');
            $table->string('warrenty');
            $table->string('screen_protector');
            $table->string('charger_cable');
            $table->string('date');
            $table->string('time');
            $table->string('address');
            $table->string('unit_floor');
            $table->string('name');
            $table->string('phone');
            $table->string('email');
            $table->string('total_price');
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
        Schema::dropIfExists('booking');
    }
}
