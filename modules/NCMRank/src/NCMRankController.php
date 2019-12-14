<?php
namespace JingBh\NCMRank;

use App\Http\Controllers\Controller;

class NCMRankController extends Controller
{
    public function index() {
        $users = NCMUser::orderBy("total", "DESC")->get();
        return view("ncmrank::index", ["users" => $users]);
    }

    public function data($user) {
        return response()->json(NCMRank::analysisById($user));
    }
}
