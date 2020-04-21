<?php
namespace JingBh\AutoZP;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
use JingBh\AutoZP\Models\AutoZPUser as Model;
use JingBh\AutoZP\Traits\StudentInfo;

class AutoZPUser
{
    /**
     * 用户名密码 Cookie 过期时间 (分钟)
     * 此处为一个月
     *
     * @var int
     */
    const cookieTime = 60 * 24 * 30;

    /**
     * Token Cache 过期时间
     * 此处为三小时
     *
     * @var int
     */
    const tokenCacheTime = 60 * 60 * 3;

    /**
     * 用户模型
     *
     * @var Model|null
     */
    protected $obj = null;

    /**
     * 从综评系统获取的用户信息
     *
     * @var array|null
     */
    protected $userInfo = null;

    /**
     * @var string
     */
    public $token = "";

    /**
     * 用户教育ID
     *
     * @var string
     */
    public $userId = "";

    public function __construct($token="") {
        $this->token = $token;
    }

    /**
     * 从综评系统获取用户信息
     *
     * @return array|null
     */
    public function updateUserInfo() {
        if (blank($this->userInfo)) {
            try {
                $response = WebSpider::userInfo($this->token);
                $this->userInfo = $response["data"];
                if (filled($this->userInfo)) $this->userId = $this->userInfo["userNumber"];
            } catch (\Throwable $e) {
                $this->userInfo = null;
            }
        }
        return $this->userInfo;
    }

    /**
     * 从综评系统获取用户分数
     *
     * @return array|null
     */
    public function updateUserScore() {
        if (blank($this->userInfo)) {
            try {
                $response = WebSpider::userScore($this->token);
                $this->userInfo = $response["data"];
            } catch (\Throwable $e) {
                $this->userInfo = null;
            }
        }
        return $this->userInfo;
    }

    /**
     * 实例化用户模型
     *
     * @return Model
     */
    public function updateModel() {
        $this->updateUserInfo();
        $obj = Model::find($this->userId);
        if (empty($obj)) {
            $obj = new Model;
            $obj->id = $this->userId;
            $obj->invite_code = InviteCode::getFromCookie();
            $obj->save();
        }
        $this->obj = $obj;
        return $this->obj;
    }

    /**
     * 尝试获取学生照片
     *
     * @return string|null
     */
    public function getPhoto() {
        $eduId = $this->userId;
        $schoolId = $this->getSchoolId();
        $year = $this->getGradeYear() + 3;
        $cacheTime = 60 * 60 * 24 * 30; // A month
        return Cache::remember("autozp_photo_{$eduId}_{$schoolId}_{$year}", $cacheTime,
            function() use ($eduId, $schoolId, $year) {
                return WebSpider::photo($eduId, $schoolId, $year);
            });
    }

    /**
     * 获取分数排名表
     *
     * @param null|bool $grade 是否获取全年级学生分数
     * @param null|array $params 自定义请求参数
     * @return array
     */
    public function getRank($grade=false, $params=null) {
        if (blank($params)) {
            $termInfo = $this->getTermInfo();
            $params = [
                "orgId" => $termInfo["orgId"],
                "schoolyearId" => $termInfo["yearId"],
                "schoolsemesterId" => $termInfo["semesterId"],
                "gradeId" => $termInfo["gradeId"]
            ];
            if ($grade !== true) $params["classId"] = $termInfo["classId"];
        }
        try {
            $response = WebSpider::rankTable($this->token, $params);
            $data = $response["data"];
            $result = [];
            foreach ($data as $item) {
                array_push($result, [
                    "id" => $item["userNumber"],
                    "name" => $item["name"],
                    "score" => $item["rankScore"]
                ]);
            }
            return $result;
        } catch (\Throwable $e) {
            return [];
        }
    }

    /**
     * 获取历史记录表
     *
     * @param null|array $params 请求参数
     * @return array
     */
    public function getRecords($params=[]) {
        $termInfo = $this->getTermInfo();
        if (filled($termInfo)) $params = array_merge([
            "schoolyearId" => $termInfo["yearId"],
            "schoolsemesterId" => $termInfo["semesterId"]
        ], $params);
        try {
            $response = WebSpider::records($this->token, $params);
            $result = [];
            $data = $response["data"]["list"];
            if (filled($data))
                foreach ($data as $item) {
                    array_push($result, [
                        "id" => $item["id"],
                        // "category" => $item["categoryId"],
                        // "template" => $item["recordTemplate"],
                        "title" => $item["title"],
                        "content" => $item["content"],
                        "date" => $item["submittedDate"],
                        "score" => $item["score"],
                        "submitter" => $item["submitterName"],
                        "attachments" => Attachment::parseAttachmentsList($item["attachments"] ?? [])
                    ]);
                }
            return $result;
        } catch (\Throwable $e) {
            return [];
        }
    }

    /**
     * 检查是否已登录
     *
     * @return bool
     */
    public function isLoggedIn() {
        if (filled($this->token)) {
            $this->updateUserInfo();
            return filled($this->userInfo);
        } else return false;
    }

    /**
     * 将 Token 保存在 Session 和 Cache 中
     */
    public function saveToken() {
        Session::put("autozp_token", $this->token);
        Cache::put("autozp_token_{$this->userId}", $this->token,
            self::tokenCacheTime);
    }

    /**
     * 将保存在 Session 和 Cache 中的 Token 删除
     */
    public function clearToken() {
        Session::remove("autozp_token");
        Cache::forget("autozp_token_{$this->userId}");
    }

    /**
     * 在数据库和 Cookie 中保存密码
     * 密码已加密存储
     *
     * @param $password
     * @return void
     */
    public function savePassword($password) {
        $obj = $this->updateModel();
        if (filled($obj)) {
            $obj->password = $password;
            $obj->save();
        }
        $this->obj = $obj;
        Cookie::queue("autozp_username", $obj->id, self::cookieTime);
        Cookie::queue("autozp_password", $obj->password, self::cookieTime);
    }

    /**
     * 清除存储的密码
     *
     * @return void
     */
    public function clearPassword() {
        $obj = $this->updateModel();
        if (filled($obj)) {
            $obj->password = null;
            $obj->save();
        }
        $this->obj = $obj;
    }

    /**
     * 登录综评系统
     * 不填验证码时为自动识别
     *
     * @param string $username
     * @param string $password
     * @param string|null $flag
     * @param string|null $validateCode
     * @return array
     * @throws \Throwable
     */
    public static function login($username, $password, $flag=null, $validateCode=null) {
        $user = Model::find($username);
        if (filled($user) || InviteCode::isValid(null, true)) {
            $token = Cache::get("autozp_token_{$username}");
            if (blank($token)) {
                if (filled($validateCode) && filled($flag)) {
                    $response = WebSpider::login($username, $password, $flag, $validateCode);
                } else $response = NoMoreValidateCode::getAndFuckIt($username, $password);
            } else {
                $response = [
                    "success" => true,
                    "message" => "已从缓存中获取登录信息",
                    "data" => ["token" => $token]
                ];
            }
        } else {
            InviteCode::clearCookie();
            $response = [
                "success" => false,
                "message" => "您的邀请码不能用来登录此账号。",
                "data" => null,
                "reload" => true
            ];
        }
        if ($response["success"] === true) {
            $response["object"] = new self($response["data"]["token"]);
        } else $response["object"] = new self;
        $response["object"]->userId = $username;
        if ($response["object"]->isLoggedIn()) {
            $response["object"]->updateModel();
            $response["object"]->saveToken();
        } elseif ($response["success"] === true) {
            $response["success"] = false;
            $response["message"] = "这通常并不是您的错，请直接重试。";
            $response["object"]->clearToken();
            $response = self::login($username, $password, $flag, $validateCode);
        }
        return $response;
    }

    /**
     * 退出登录并清理 Session
     */
    public static function logout() {
        Session::remove("autozp_token");
    }

    /**
     * 从 Session 中获取当前用户 Token
     *
     * @param boolean $construct 是否实例化此类
     * @return self|string|null
     */
    public static function getTokenFromSession($construct=true) {
        $token = Session::get("autozp_token");
        return $construct ? new self($token) : $token;
    }

    use StudentInfo;
}
