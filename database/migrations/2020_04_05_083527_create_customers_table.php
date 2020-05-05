<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            
			$table->id();
			$table->string('name');
			$table->string('address')->nullable();
			$table->string('customer_code');
			$table->string('mobile_phone')->nullable();
			$table->string('lat')->nullable();
            $table->string('lng')->nullable();
            
            $table->bigInteger('distribution_center_id')->default(0);
            
			$table->date('join_at');

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
        Schema::dropIfExists('customers');
    }
}
