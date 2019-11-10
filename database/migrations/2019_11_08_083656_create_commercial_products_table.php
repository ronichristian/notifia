<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommercialProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commercial_products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('product_name');
            $table->string('sponsor');
            $table->string('description', 100)->nullable();
            $table->string('store_name')->nullable();
            $table->double('product_price')->nullable();
            // $table->binary('avatar')->nullable();
            $table->timestamps();
        });  
        DB::statement("ALTER TABLE commercial_products ADD avatar MEDIUMBLOB");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('commercial_products');
    }
}
