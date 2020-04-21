<?php
namespace JingBh\AutoZP\Http\Controllers;

use App\Http\Controllers\Controller;
use JingBh\AutoZP\Http\Middleware\LoadUser;

class HomeController extends Controller
{
    public function __construct() {
        $this->middleware(LoadUser::class);
    }

    public function home() {
        return view("autozp::home");
    }

    public function manifest() {
        return response()->file(__DIR__ . "/../../../resources/manifest.json", [
            "Content-Type" => "application/manifest+json"
        ]);
    }
}
