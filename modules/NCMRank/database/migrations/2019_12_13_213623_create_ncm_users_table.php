<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNCMUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("ncm_users", function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->char("name", 90)->nullable();
            $table->text("avatar")->nullable();
            $table->tinyInteger("level")->nullable();
            $table->mediumInteger("total")->nullable();
            $table->dateTime("reg_time")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("ncm_users");
    }
}
