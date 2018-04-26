<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgentRankTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('agent_rank_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('rank')->unique();
            $table->string('description');
            $table->string('commission_rate',10,2);
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
        
        Schema::table('agent_rank_types', function (Blueprint $table) {
           Schema::disableForeignKeyConstraints();
        });
        Schema::dropIfExists('agent_rank_types');
    }
}
