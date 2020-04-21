<?php
namespace JingBh\AutoZP\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use JingBh\AutoZP\InviteCode;

class InviteCodeController extends Controller
{
    public function show() {
        $valid = InviteCode::isValid();
        if ($valid === true) return redirect("/autozp");
        return view("autozp::verify_invite");
    }

    public function verify(Request $request) {
        $code = $request->post("code");
        $valid = InviteCode::isValid($code);
        if ($valid === true) InviteCode::saveToCookie($code);
        return response()->json([$valid, URL::previous("/autozp")]);
    }
}
