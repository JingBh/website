<?php
namespace JingBh\AutoZP;

use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;

class WebSpider
{
    /**
     * 登录综评系统
     *
     * @param string $username 用户名
     * @param string $password 密码
     * @param string $flag 获取验证码时返回的 $flag
     * @param string $validate_code 验证码
     * @return array 其中token为身份验证使用的Bearer秘钥
     */
    public static function login($username, $password, $flag, $validate_code) {
        $client = self::http();
        $encrypted_password = (new EncryptPassword)($password, $validate_code);
        $response = $client->post("auth/login", [
            "form_params" => [
                "application" => "student",
                "usernameOrEmail" => $username,
                "password" => $encrypted_password,
                "flag" => $flag,
                "validateCode" => $validate_code
            ]
        ]);
        return self::apiJsonResponse($response);
    }

    /**
     * 获取用户信息
     *
     * @param $token
     * @return array
     */
    public static function userInfo($token) {
        $client = self::http($token);
        $response = $client->get("school/user/getUserInfo");
        return self::apiJsonResponse($response);
    }

    /**
     * 获取用户分数
     *
     * @param $token
     * @return array
     */
    public static function userScore($token) {
        $client = self::http($token);
        $response = $client->get("record/getUserScoreAndCount");
        return self::apiJsonResponse($response);
    }

    /**
     * 获取分数排名表
     *
     * @param $token
     * @param array $params URL查询参数
     * @return array
     */
    public static function rankTable($token, $params=[]) {
        $client = self::http($token);
        if (!array_key_exists("num", $params)) $params["num"] = 10000;
        $response = $client->get("statistics/studentRecord/ranking", [
            "query" => $params
        ]);
        return self::apiJsonResponse($response);
    }

    /**
     * 获取历史记录表
     *
     * @param $token
     * @param array $params
     * @return array
     */
    public static function records($token, $params=[]) {
        $defaults = [
            "sortField" => "submittedDate",
            "sortType" => "-1",
            "pageIndex" => "1",
            "submittedSelf" => "",
            "pageSize" => "10000"
        ];
        $client = self::http($token);
        $response = $client->get("record/published/getListPage", [
            "query" => array_merge($defaults, $params)
        ]);
        return self::apiJsonResponse($response);
    }

    /**
     * 获取综评系统登录验证码
     *
     * @return array
     */
    public static function getValidateCode() {
        $client = self::http();
        $response = $client->get("auth/validateCode");
        $body = json_decode($response->getBody()->getContents());
        $image_url = "data:image/jpeg;base64," . $body->data->imgsrc;
        $image = file_get_contents($image_url);
        return [
            "flag" => $body->data->flag,
            "image_url" => $image_url,
            "image_base64" => $body->data->imgsrc,
            "image" => $image
        ];
    }

    /**
     * 获取模板列表
     *
     * @param $token
     * @return array
     */
    public static function getTemplateList($token) {
        $client = self::http($token);
        $response = $client->get("admin/category/getUpAllAndTemByUser");
        return self::apiJsonResponse($response);
    }

    /**
     * 获取照片，失败时返回null
     *
     * @param string $eduId 教育ID
     * @param string $schoolId 学校ID
     * @param int|string $year 毕业年份
     * @return string|null
     */
    public static function photo($eduId, $schoolId, $year) {
        $client = new Client([
            "base_uri" => "http://211.153.80.221/static/cmisfolder/photos/",
            "connect_timeout" => 30,
            "headers" => [
                "User-Agent" => "Mozilla/5.0 JWS AutoZPBot",
                "Referer" => "http://211.153.82.39/usercenter/",
                "Origin" => "http://211.153.80.221"
            ],
            "timeout" => 60
        ]);
        try {
            $response = $client->get("2012003/{$year}/{$schoolId}/{$eduId}.jpg");
            if ($response->getStatusCode() == 200) {
                return $response->getBody()->getContents();
            } else return null;
        } catch (\Throwable $e) {
            return null;
        }
    }

    /**
     * 生成一个 Guzzle HTTP 客户端
     *
     * @param string|null $token Bearer Token
     * @param bool $api 是否为调用 API
     * @return Client
     */
    protected static function http($token=null, $api=true) {
        $options = [
            "base_uri" => $api
                ? "http://gzzp.bjedu.cn:8004/"
                : "http://gzzp.bjedu.cn/",
            "connect_timeout" => 30,
            "headers" => [
                "User-Agent" => "Mozilla/5.0 JWS AutoZPBot",
                "Referer" => "http://gzzp.bjedu.cn/",
                "Origin" => "http://gzzp.bjedu.cn"
            ],
            "timeout" => 30
        ];

        if (filled($token)) {
            $options["headers"]["Authorization"] = "Bearer {$token}";
            $options["query"]["token"] = $token;
        }

        return new Client($options);
    }

    /**
     * 将 API 响应转换为数组
     *
     * @param ResponseInterface $response
     * @return array
     */
    protected static function apiJsonResponse($response) {
        $body = json_decode($response->getBody()->getContents(), true);
        return [
            "success" => $body["success"],
            "message" => $body["message"],
            "data" => $body["success"]
                ? $body["data"] : null
        ];
    }
}
