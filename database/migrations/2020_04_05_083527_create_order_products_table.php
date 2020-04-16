<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_products', function (Blueprint $table) {
            
			$table->id();
			$table->bigInteger('order_id');
			$table->bigInteger('product_id');
			$table->bigInteger('price');
			$table->bigInteger('qty');
            $table->bigInteger('total')->default(0);
            
            $table->bigInteger('actual_qty')->default(0);
            $table->bigInteger('actual_total')->default(0);

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
        Schema::dropIfExists('order_products');
    }
}
