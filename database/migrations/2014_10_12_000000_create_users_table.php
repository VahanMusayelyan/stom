<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('m_name');
            $table->string('l_name');
            $table->string('email')->unique();
            $table->string('login');
            $table->string('phone');
            $table->integer('role_id')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('provider')->nullable();
            $table->integer('provider_id')->nullable();
            $table->rememberToken();
            $table->integer('user_active')->default(1);
            $table->integer('preview')->default(0);
            $table->timestamps();
            $table->dateTime('deleted_at', 0)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
