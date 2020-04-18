<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Schema\Builder;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Builder::defaultStringLength(191); // Update defaultStringLength

        Schema::create('settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger("user_id");
            $table->text("appearance");
            $table->text("notification");
            $table->text("others");
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
        Schema::dropIfExists('settings');
    }
}
