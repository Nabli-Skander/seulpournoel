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
            $table->increments('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->text('location');
            $table->string('city');
            $table->text('state');
            $table->string('country');
            $table->decimal('lng', 10, 7);
            $table->decimal('lat', 10, 7);
            $table->string('phone')->unique()->nullable();
            $table->string('email')->unique();
            $table->text('about')->nullable();
            $table->text('lang', 2);
            $table->string('password');
            $table->string('image')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
