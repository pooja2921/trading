<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('company_id')->nullable();
            $table->string('item_code')->nullable();
            $table->string('super_speciality')->nullable();
            $table->string('name')->nullable();
            $table->string('brand')->nullable();
            $table->string('image')->nullable();
            $table->string('reference_link')->nullable();
            $table->string('video_link')->nullable();
            $table->string('image_link')->nullable();
            $table->string('warranty')->nullable();
            $table->string('lifecycle')->nullable();
            $table->string('made_in_country')->nullable();
            $table->string('product_nature')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('company_id')->references('id')->on('tanents')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
