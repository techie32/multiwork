<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMobileInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mobile_info', function (Blueprint $table) {
            $table->id();
            $table->string('mobile_name');
            $table->string('model');
            $table->string('device_issue_name')->nullable();
            $table->longtext('image'); 
            $table->string('battery_replacement_price')->nullable();
            $table->string('screen_replacement_price')->nullable();
            $table->string('modelcategory')->nullable();
            $table->string('warrenty_name')->nullable();
            $table->string('warrenty_price')->nullable();
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
        Schema::dropIfExists('mobile_info');
    }
}
