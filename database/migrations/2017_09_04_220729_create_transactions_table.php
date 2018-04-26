<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->increments('id');   
            $table->integer('agent_id')->unsigned();
            $table->integer('developer_id')->unsigned();
            $table->integer('client_id')->unsigned();
            $table->integer('project_id')->unsigned();
            $table->string('project_name');
            $table->text('project_description')->nullable();
            $table->string('project_location')->nullable();
            $table->integer('project_type')->nullable();
            $table->integer('agent_rank');
            $table->decimal('assumed_commission',10,2); 
            $table->integer('added_by')->unsigned();
            $table->boolean('cancelled')->default(0);
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
        Schema::dropIfExists('transactions');
    }
}
