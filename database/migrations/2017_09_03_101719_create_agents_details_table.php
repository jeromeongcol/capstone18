<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgentsDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agents_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('agent_id')->unsigned();
            $table->integer('recruiter')->unsigned()->nullable();
            $table->integer('recruits')->default(0)->nullable();
            $table->boolean('approved')->default(0)->nullable();
            $table->integer('approved_by')->unsigned()->nullable();
            $table->timestamps();
        });

         Schema::table('agents_details', function (Blueprint $table) {
            $table->foreign('agent_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('approved_by')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('agents_details', function (Blueprint $table) {
           Schema::disableForeignKeyConstraints();
        });

        Schema::dropIfExists('agents_details');


    }
}
