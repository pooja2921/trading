<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCityCodeToVendorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vendors', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable()->after('company_id');
            $table->unsignedBigInteger('country_id')->nullable()->after('address_2');
            $table->unsignedBigInteger('city_id')->nullable()->after('address_2');
            $table->unsignedBigInteger('state_id')->nullable()->after('address_2');
            $table->tinyInteger('city_code')->nullable()->after('secondary_email');
            $table->unsignedBigInteger('secondary_country_id')->nullable()->after('address_2');
            $table->unsignedBigInteger('secondary_city_id')->nullable()->after('address_2');
            $table->unsignedBigInteger('secondary_state_id')->nullable()->after('address_2');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('set null');
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('set null');
            $table->foreign('state_id')->references('id')->on('states')->onDelete('set null');
            $table->foreign('secondary_country_id')->references('id')->on('countries')->onDelete('set null');
            $table->foreign('secondary_city_id')->references('id')->on('cities')->onDelete('set null');
            $table->foreign('secondary_state_id')->references('id')->on('states')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('vendors', function (Blueprint $table) {
            //
        });
    }
}
