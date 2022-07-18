<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('email', 100);
            $table->string('phone', 20);
            $table->string('country', 10);
            $table->string('district', 50);
            $table->longText('shipAdreess');
            $table->integer('orderQuantity');
            $table->double('orderPrice');
            $table->double('shipmentCost')->default(5);
            $table->double('totalPrice');
            $table->string('paymentMethod', 50)->default('cod');
            $table->unsignedSmallInteger('status')->default(0)->comment('0=process,1=shiping,2=deliverig,3=delivered,4=complete');
            $table->date('date')->useCurrent();
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
        Schema::dropIfExists('orders');
    }
}
