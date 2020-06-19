<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id');
            $table->text('title');
            $table->text('description');
            $table->float('price');
            $table->dateTime('date');
            $table->text('location');
            $table->text('address');
            $table->text('postal_code');
            $table->text('city');
            $table->text('country');
            $table->text('state');
            $table->text('longitude');
            $table->text('latitude');
            $table->integer('user_id')->unsigned()->default(0);
            $table->foreign('user_id')
              ->references('id')->on('users')
              ->onDelete('cascade');
            $table->string('image')->nullable();
            $table->smallInteger('boost')->default(0);
            $table->timestamps();
        });


        Schema::create('events_users', function ($table) {
            $table->increments('id');
            $table->integer('event_id')->unsigned();
            $table->foreign('event_id')->references('id')->on('events');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->text('message');
            $table->enum('status', ['new', 'accepted', 'refused'])->default('new');
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
        Schema::dropIfExists('events_users');
        Schema::dropIfExists('events');
    }
}
