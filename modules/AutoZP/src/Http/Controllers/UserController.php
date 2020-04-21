<?php
namespace JingBh\AutoZP\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use JingBh\AutoZP\AutoZPUser;
use JingBh\AutoZP\RecordTemplate;
use JingBh\AutoZP\WebSpider;

class UserController extends Controller
{
    public function login(Request $request) {
        $username = $request->post("username");
        $password = $request->post("password");
        $flag = $request->post("flag");
        $validateCode = $request->post("validateCode");
        $remember = $request->post("remember") == "true";
        $result = AutoZPUser::login($username, $password, $flag, $validateCode);
        if ($result["success"] === true && $remember === true) {
            $result["object"]->savePassword($password);
        } elseif ($result["object"]->isLoggedIn()) {
            $result["object"]->clearPassword();
        }
        return response()->json($result);
    }

    public function logout(Request $request) {
        AutoZPUser::logout();
        if ($request->isMethod("GET")) {
            return redirect("/autozp");
        } else return response()->json([true, null]);
    }

    public function validateCode() {
        $result = WebSpider::getValidateCode();
        Arr::forget($result, ["image", "image_base64"]);
        return response()->json([true, $result]);
    }

    /**
     * 从 Session 中获取当前 Token
     *
     * @return \Illuminate\Http\Response
     */
    public function getToken() {
        $token = AutoZPUser::getTokenFromSession(false);
        return response($token)->header("Content-Type", "text/plain");
    }

    public function templates() {
        $response = (new RecordTemplate())->getList();
        return response()->json([true, $response]);
    }

    public function userInfo() {
        $obj = AutoZPUser::getTokenFromSession();
        $userInfo = $obj->updateUserInfo();
        $result = filled($userInfo) ? [
            "id" => $obj->userId,
            "name" => $userInfo["name"],
            "gender" => $userInfo["sex"],
            "school" => $obj->getSchool(),
            "term" => $obj->getTermInfo()
        ] : null;
        return response()->json([true, $result]);
    }

    public function userScore() {
        $obj = AutoZPUser::getTokenFromSession();
        $userScore = $obj->updateUserScore();
        $result = filled($userScore) ? [
            "score" => $userScore["score"],
            "count" => $userScore["count"]
        ] : null;
        return response()->json([true, $result]);
    }

    public function photo() {
        $obj = AutoZPUser::getTokenFromSession();
        if ($obj->isLoggedIn()) {
            $photo = $obj->getPhoto();
            if (filled($photo)) {
                return response()->streamDownload(function() use ($photo) {
                    echo $photo;
                }, null, [
                    "Content-Type" => "image/jpeg"
                ], "inline");
            }
        }
        return response("Photo not found.")->setStatusCode(404);
    }

    public function rank(Request $request) {
        $custom = $request->get("custom", "no") === "yes";
        $grade = $request->get("grade", "no") === "yes";
        $obj = AutoZPUser::getTokenFromSession();
        if ($custom) {
            $params = $request->all(["orgId", "schoolyearId",
                "schoolsemesterId", "gradeId", "classId"]);
            $response = $obj->getRank(null, $params);
        } else $response = $obj->getRank($grade);
        return response()->json([true, $response]);
    }

    public function records(Request $request) {
        $obj = AutoZPUser::getTokenFromSession();
        $params = $request->all();
        $response = $obj->getRecords($params);
        return response()->json([true, $response]);
    }
}
