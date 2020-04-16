<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TcGenerator extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('generators', function(Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('generate_from');
            $table->string('healthy');
            $table->text('config');
            $table->string('status');
            $table->datetime('generated_at');
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
        //
        Schema::dropIfExists('generators');
        
    }
}
