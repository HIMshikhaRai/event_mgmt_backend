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
             $table->id();
        $table->string('name');
        $table->string('description');
        $table->string('address');
        $table->string('start_date');
        $table->string('end_date');
        $table->string('event_picture');
        $table->string('ticket_type');
        $table->integer('ticket_price');
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
        Schema::dropIfExists('events');
    }
}
