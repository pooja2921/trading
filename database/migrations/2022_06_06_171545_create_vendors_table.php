<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendors', function (Blueprint $table) {
            $table->id();
            $table->string('vendor_code')->nullable();
            $table->string('product_group')->nullable();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->unsignedBigInteger('subcategory_id')->nullable();
            $table->string('nature_of_bussiness')->nullable();
            $table->string('company_name')->nullable();
            $table->string('primary_contact_person')->nullable();
            $table->string('designation')->nullable();
            $table->string('mobile')->nullable();
            $table->string('mobilealt')->nullable();
            $table->string('email')->unique();
            $table->string('secondary_contact_person')->nullable();
            $table->string('secondary_designation')->nullable();
            $table->string('secondary_mobile')->nullable();
            $table->string('secondary_email')->unique();
            $table->string('landline')->unique();
            $table->string('address_1')->nullable();
            $table->string('address_2')->nullable();
            $table->string('city')->nullable();
            $table->unsignedBigInteger('state_id')->nullable();
            $table->string('pincode')->nullable();
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
        Schema::dropIfExists('vendors');
    }
}
