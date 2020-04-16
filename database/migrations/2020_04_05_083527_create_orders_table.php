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
			$table->date('date_delivery');
			$table->integer('ttl_price');
			$table->integer('ttl_qty');
			$table->bigInteger('customer_id');

            $table->bigInteger('ttl_actual_qty')->default(0);
            $table->bigInteger('ttl_actual_total')->default(0);

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
