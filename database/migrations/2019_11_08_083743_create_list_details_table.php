<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateListDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('list_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('prediction');
            $table->string('product_name');
            $table->string('store_name')->nullable();
            $table->integer('quantity')->nullable();
            $table->double('product_price')->nullable();
            $table->double('subtotal')->nullable();
            $table->boolean('is_checked')->nullable();
            $table->integer('product_id')->nullable();
            $table->integer('user_list_id');
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
        Schema::dropIfExists('list_details');
    }
}
