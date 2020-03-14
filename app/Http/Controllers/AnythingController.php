<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnythingController extends Controller
{
    public function upload(Request $request) {
        return response()->json(
            DB::table("anything")->insert([
                "ip" => json_encode($request->getClientIps()),
                "headers" => json_encode($request->header()),
                "data" => json_encode($request->all()),
                "created_at" => now()
            ])
        )->header("Access-Control-Allow-Origin", "*");
    }
}
