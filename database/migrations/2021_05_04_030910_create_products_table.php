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
            $table->foreignId('user_id')->constrained();
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->string('productName', 100);
            $table->float('unitPrice', 8, 2);
            $table->string('image', 50);
            $table->string('availableSize', 100)->nullable();
            $table->string('availableColor', 100)->nullable();
            $table->float('discount', 8, 2)->nullable();
            $table->float('unitWeight', 3, 2)->nullable();
            $table->bigInteger('unitStock')->nullable();
            $table->text('product_sort_desc')->nullable();
            $table->text('product_long_desc')->nullable();
            $table->integer('rank')->nullable();
            $table->integer('status')->comment('0=draft,1=publish,2=trashed')->default(0);
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
        Schema::dropIfExists('products');
    }
}
