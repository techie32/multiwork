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
            $table->integer('zip_code')->nullable();
            $table->string('service_type')->nullable();
            $table->integer('model')->nullable();
            $table->string('device_issue_name')->nullable();
            $table->string('device_issue_description')->nullable();
            $table->string('screen_color')->nullable();
            $table->string('warrenty')->nullable();
            $table->string('screen_protector')->nullable();
            $table->string('charger_cable')->nullable();
            $table->string('date')->nullable();
            $table->string('time')->nullable();
            $table->string('address')->nullable();
            $table->string('unit_floor')->nullable();
            $table->string('name')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('total_price')->nullable();
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
