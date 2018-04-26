<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
           
            Schema::table('users', function (Blueprint $table) {
                $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
                $table->foreign('added_by')->references('id')->on('users')->onDelete('cascade');
                $table->foreign('person_id')->references('id')->on('persons')->onDelete('cascade');
            });

            Schema::table('avatars', function (Blueprint $table) {
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            });

           Schema::table('agent_ranks', function (Blueprint $table) {
                $table->foreign('agent_id')->references('id')->on('users')->onDelete('cascade');
                $table->foreign('rank_type_id')->references('id')->on('agent_rank_types')->onDelete('cascade');
            });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('persons', function (Blueprint $table) {
           Schema::disableForeignKeyConstraints();
        });

        Schema::table('users', function (Blueprint $table) {
           Schema::disableForeignKeyConstraints();
        });

        Schema::table('avatars', function (Blueprint $table) {
           Schema::disableForeignKeyConstraints();
        });

        Schema::table('agent_ranks', function (Blueprint $table) {
           Schema::disableForeignKeyConstraints();
        });

        Schema::dropIfExists('persons');
        Schema::dropIfExists('users');
        Schema::dropIfExists('avatars');
        Schema::dropIfExists('agent_ranks');
    }
}

