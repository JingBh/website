<?php
namespace JingBh\AutoZP\Http\Controllers;

use App\Http\Controllers\Controller;

class StaticController extends Controller
{
    public function terms() {
        return view("autozp::terms");
    }
}
