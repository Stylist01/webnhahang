<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->string('order_id');
            $table->integer('customer_id')->nullable();
            $table->double('total_money')->nullable();
            $table->double('payment')->nullable();
            $table->integer('status_payment')->nullable();
            $table->longText('status')->nullable();
            $table->string('vendor_order_id')->nullable();
            $table->dateTime('implementation_date')->nullable();
            $table->longText('detail')->nullable();
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
        Schema::dropIfExists('carts');
    }
}
