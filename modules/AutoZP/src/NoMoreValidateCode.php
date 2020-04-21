<?php
namespace JingBh\AutoZP;

use Illuminate\Support\Str;

class NoMoreValidateCode
{
    /**
     * 尝试破解验证码并登录
     * 每次调用最多尝试 10 次
     *
     * @param $username
     * @param $password
     * @return array
     * @see WebSpider::login
     * @throws \Throwable
     */
    public static function getAndFuckIt($username, $password) {
        $count = 0;
        while ($count < 10) {
            $get_code = WebSpider::getValidateCode();
            $code = self::tryOnce($get_code["image_base64"]);
            $try_login = WebSpider::login($username, $password, $get_code["flag"], $code);
            if (!Str::contains($try_login["message"], "验证码")) return $try_login;
            $count ++;
            sleep(1);
        }
        throw new \Exception("Max tries reached.");
    }

    /**
     * 尝试破解验证码一次
     *
     * @param $image
     * @see BaiduOCR::numbers
     * @return string 破解结果
     * @throws \Throwable
     */
    public static function tryOnce($image) {
        $result = BaiduOCR::numbers($image);
        if (isset($result["words_result"][0])) {
            return $result["words_result"][0]["words"];
        } else {
            return "";
        }
    }
}
