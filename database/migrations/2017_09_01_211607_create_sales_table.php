<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('transaction_id')->unsigned();
            $table->date('date_reserve');
            $table->decimal('total_contract_price',10,2);  
            $table->boolean('approved')->default(0)->nullable();
            $table->integer('approved_by')->unsigned();
            $table->boolean('cancelled')->default(0)->nullable();          
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

        Schema::dropIfExists('sales');
    }
}
