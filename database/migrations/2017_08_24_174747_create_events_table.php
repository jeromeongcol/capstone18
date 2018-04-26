<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->string('title');
            $table->text('description')->nullable();
            $table->dateTime('start');
            $table->dateTime('end');
            $table->string('date')->nullable();
            $table->string('time')->nullable();
            $table->string('speaker');
            $table->string('venue'); 
            $table->integer('added_by')->unsigned();
            $table->string('status')->default('upcoming');
            $table->string('backgroundColor')->default("#0fa5bb")->nullable();
            $table->string('textColor')->default("#0fa5bb")->nullable();
            $table->timestamps();
        });

        Schema::table('events', function (Blueprint $table) {
            $table->foreign('added_by')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        
        Schema::table('events', function (Blueprint $table) {
           Schema::disableForeignKeyConstraints();
        });

        Schema::dropIfExists('events');
    }
}
