<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSecondaryCityIdToClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->string('secondary_city_id')->nullable();
            $table->unsignedBigInteger('secondary_state_id')->nullable();
            $table->string('secondary_pincode')->nullable();
            $table->string('secondary_latitude')->nullable();
            $table->string('secondary_longitude')->nullable();
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
        Schema::table('clients', function (Blueprint $table) {
            //
        });
    }
}
