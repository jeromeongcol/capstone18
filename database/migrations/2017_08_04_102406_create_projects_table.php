<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('developer_id')->unsigned();
            $table->string('project_name');
            $table->text('project_description')->nullable();
            $table->string('project_location')->nullable();
            //$table->decimal('project_price',10,2);
            $table->string('featured_photo')->nullable()->default("/images/default.png");
            $table->integer('project_type_id')->unsigned();
            $table->integer('added_by')->unsigned();
            $table->boolean('deleted')->default(0);
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
        Schema::dropIfExists('projects');
    }
}
