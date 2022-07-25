<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCityIdToEnquiriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('enquiries', function (Blueprint $table) {
            $table->unsignedBigInteger('client_country_id')->nullable()->after('company_name');
            $table->unsignedBigInteger('client_state_id')->nullable()->after('client_country_id');
            $table->unsignedBigInteger('client_city_id')->nullable()->after('client_state_id');
            $table->text('client_address_line1')->nullable()->after('client_city_id');
            $table->text('client_address_line2')->nullable()->after('client_address_line1');

            $table->unsignedBigInteger('corporate_id')->nullable()->after('client_address_line2');
            $table->string('corporate_company_name')->nullable()->after('corporate_id');

            $table->unsignedBigInteger('corporate_country_id')->nullable()->after('corporate_company_name');
            $table->unsignedBigInteger('corporate_state_id')->nullable()->after('corporate_country_id');
            $table->unsignedBigInteger('corporate_city_id')->nullable()->after('corporate_state_id');
            $table->text('corpotate_address_line1')->nullable()->after('corporate_city_id');
            $table->text('corporate_address_line2')->nullable()->after('corpotate_address_line1');

            $table->foreign('client_country_id')->references('id')->on('countries')->onDelete('set null');
            $table->foreign('client_state_id')->references('id')->on('states')->onDelete('set null');
            $table->foreign('client_city_id')->references('id')->on('cities')->onDelete('set null');

            $table->foreign('corporate_country_id')->references('id')->on('countries')->onDelete('set null');
            $table->foreign('corporate_state_id')->references('id')->on('states')->onDelete('set null');
            $table->foreign('corporate_city_id')->references('id')->on('cities')->onDelete('set null');
            $table->foreign('corporate_id')->references('id')->on('corporates')->onDelete('set null');
            
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('enquiries', function (Blueprint $table) {
            //
        });
    }
}
