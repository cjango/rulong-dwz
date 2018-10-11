<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username', 32);
            $table->string('password');
            $table->string('nickname', 32)->nullable();
            $table->string('remember_token')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('admin_logins', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('admin_id')->unsigned();
            $table->string('login_ip', 15)->nullable();
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('admin_menus', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_id')->unsigned();
            $table->string('title', 64);
            $table->integer('sort')->unsigned();
            $table->string('uri')->nullable();
            $table->timestamps();
        });

        Schema::create('admin_operation_logs', function (Blueprint $table) {
            $table->bigInteger('id', true)->unsigned();
            $table->integer('admin_id')->unsigned()->index();
            $table->string('path');
            $table->string('method', 10);
            $table->string('ip', 15);
            $table->text('input')->nullable();
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('admin_roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 64);
            $table->string('description')->nullable();
            $table->text('rules')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('admin_role_user', function (Blueprint $table) {
            $table->integer('role_id')->unsigned();
            $table->integer('admin_id')->unsigned();
            $table->timestamps();
            $table->primary(['role_id', 'admin_id']);
        });

        Schema::create('storages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 255);
            $table->string('hash', 32)->index();
            $table->string('type', 32);
            $table->integer('size')->unsigned();
            $table->string('path', 255);
            $table->timestamp('created_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::drop('admins');
        Schema::drop('admin_logins');
        Schema::drop('admin_menus');
        Schema::drop('admin_operation_logs');
        Schema::drop('admin_roles');
        Schema::drop('admin_role_user');
    }
}
