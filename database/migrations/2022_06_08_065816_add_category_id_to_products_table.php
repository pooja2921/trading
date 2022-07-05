<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCategoryIdToProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->unsignedBigInteger('category_id')->nullable()->after('company_id');
            $table->unsignedBigInteger('sub_category_id')->nullable()->after('category_id');
            $table->string('model_details')->nullable()->after('brand');
            $table->string('size')->nullable()->after('model_details');
            $table->string('UOM')->nullable()->after('size');
            $table->string('product_image_link')->nullable()->after('UOM');
            $table->string('packing_volume')->nullable()->after('product_nature');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('set null');
            $table->foreign('sub_category_id')->references('id')->on('categories')->onDelete('set null');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            //
        });
    }
}
