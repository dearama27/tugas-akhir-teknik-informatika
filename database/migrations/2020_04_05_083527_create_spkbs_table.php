<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpkbsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spkbs', function (Blueprint $table) {
            
			$table->id();
			$table->string('code');
			$table->date('date_delivery');
			$table->bigInteger('driver_id');
			$table->bigInteger('pic_id');
			$table->integer('ttl_order');
			$table->integer('ttl_price');
			$table->integer('ttl_qty');

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
        Schema::dropIfExists('spkbs');
    }
}
