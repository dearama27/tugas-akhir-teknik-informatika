<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeopleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('people', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->uuid('uuid')->nullable();
            $table->string('identity', 50)->nullable();
            $table->bigInteger('identity_type')->nullable();
            $table->string('firstname', 100);
            $table->string('lastname', 100);
            $table->string('nickname', 50);
            $table->date('birthday')->nullable();
            $table->string('birthday_place')->nullable();
            $table->bigInteger('gender')->nullable();

            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('people');
    }
}
