<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NCMUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("ncm_users")->truncate();
        DB::table("ncm_users")->insert([
            ["id" => 421963201, "reg_time" => "2017-02-16 13:21:17"],
            ["id" => 1419671938, "reg_time" => "2018-04-05 18:40:26"],
            ["id" => 1625283265, "reg_time" => "2018-10-04 20:32:38"],
            ["id" => 1632422315, "reg_time" => "2018-10-08 20:55:54"]
        ]);
    }
}
