<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColMobile extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mobile_info', function (Blueprint $table) {
            $table->string('modelcategory')->after('screen_replacement_price')->nullable();
            $table->string('warrenty_name')->after('modelcategory');
            $table->string('warrenty_price')->after('warrenty_name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mobile_info', function (Blueprint $table) {
           
        });
    }
}
