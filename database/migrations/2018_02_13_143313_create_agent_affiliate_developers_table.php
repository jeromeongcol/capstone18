<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgentAffiliateDevelopersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('agent_affiliate_developers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('agent_id')->unsigned();
            $table->integer('developer_id')->unsigned();
            $table->timestamps();
        });

         Schema::table('agent_affiliate_developers', function (Blueprint $table) {
            $table->foreign('agent_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('developer_id')->references('id')->on('developers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('agent_affiliate_developers', function (Blueprint $table) {
           Schema::disableForeignKeyConstraints();
        });

        Schema::dropIfExists('agent_affiliate_developers');
    }
}
