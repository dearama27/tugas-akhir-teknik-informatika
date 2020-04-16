<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UsersRoleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('access_menus', function(Blueprint $table) {
        // Schema::create('permissions_menus', function(Blueprint $table) {

            $table->bigIncrements('id');
            $table->uuid('uuid')->nullable();
            $table->bigInteger('parent_id')->default(0);
            $table->string('title');
            $table->string('description')->nullable();
            $table->string('route_name')->nullable();
            $table->string('url')->nullable();
            $table->string('icon')->nullable();
            $table->integer('order')->default(0);
            $table->string('actions')->default('[]');

            $table->timestamps();
        });

        Schema::create('access_roles', function(Blueprint $table) {
        // Schema::create('permissions_roles', function(Blueprint $table) {

            $table->bigIncrements('id');
            $table->uuid('uuid');
            $table->string('name');
            $table->string('description')->nullable();

            $table->timestamps();

        });

        Schema::create('access_actions', function(Blueprint $table) {
        // Schema::create('permissions_menu_actions', function(Blueprint $table) {

            $table->bigIncrements('id');
            $table->string       ('name');
            $table->string       ('supfix');
            $table->timestamps();

        });

        Schema::create('access_role_to_menus', function(Blueprint $table) {
        // Schema::create('permissions_role_to_menu', function(Blueprint $table) {

            $table->bigIncrements   ('id');
            $table->bigInteger      ('access_role_id');
            $table->bigInteger      ('access_menu_id');
            $table->string          ('access_action_suffix');
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
        // Schema::dropIfExists("permissions_menus");
        // Schema::dropIfExists("permissions_roles");
        // Schema::dropIfExists("permissions_menu_actions");
        // Schema::dropIfExists("permissions_role_to_menu");
        Schema::dropIfExists('access_menus');
        Schema::dropIfExists('access_roles');
        Schema::dropIfExists('access_actions');
        Schema::dropIfExists('access_role_to_menus');
    }
}
