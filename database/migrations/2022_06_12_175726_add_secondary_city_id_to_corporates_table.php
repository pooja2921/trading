<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSecondaryCityIdToCorporatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('corporates', function (Blueprint $table) {
            $table->string('secondary_city_id')->nullable()->after('longitude');
            $table->unsignedBigInteger('secondary_state_id')->nullable()->after('secondary_city_id');
            $table->string('secondary_pincode')->nullable()->after('secondary_state_id');
            $table->string('secondary_latitude')->nullable()->after('secondary_pincode');
            $table->string('secondary_longitude')->nullable()->after('secondary_latitude');
            $table->foreign('secondary_city_id')->references('id')->on('cities')->onDelete('set null');
            $table->foreign('secondary_state_id')->references('id')->on('state')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('corporates', function (Blueprint $table) {
            //
        });
    }
}
