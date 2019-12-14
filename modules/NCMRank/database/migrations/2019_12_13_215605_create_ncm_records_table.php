<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNCMRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("ncm_records", function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->bigInteger("user");
            $table->date("date");
            $table->mediumInteger("total");
            $table->timestamp("updated_at")->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("ncm_records");
    }
}
