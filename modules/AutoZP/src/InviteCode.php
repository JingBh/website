<?php
namespace JingBh\AutoZP;

use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Str;
use JingBh\AutoZP\Models\AutoZPInviteCode;

class InviteCode
{
    const cookie_name = "autozp_invite_code";

    /**
     * Cookie 有效期 (分钟)
     *
     * @var int
     */
    const cookie_time = 60 * 24 * 30;

    /**
     * 检查邀请码是否正确
     *
     * @param string|null $code 要检查的邀请码，若为空则自动从 Cookie 中获取
     * @param bool $must_unused 是否必须为未使用过的邀请码
     * @return bool
     */
    public static function isValid($code=null, $must_unused=false) {
        if (blank($code)) $code = self::getFromCookie();
        $obj = AutoZPInviteCode::where([
            ["code", "=", $code],
            ["enabled", "=", true]
        ])->first();
        if (empty($obj)) {
            return false;
        } elseif ($must_unused === true) {
            return empty($obj->user());
        } else return true;
    }

    /**
     * 生成一个新的邀请码
     *
     * @return string 生成的邀请码
     */
    public static function generate() {
        $code = Str::random(8);
        $obj = new AutoZPInviteCode;
        $obj->code = $code;
        $obj->save();
        return $code;
    }

    /**
     * 使一个邀请码失效
     *
     * @param string $code
     */
    public static function disable($code) {
        $obj = AutoZPInviteCode::find($code);
        if (filled($obj)) {
            $obj->enabled = false;
            $obj->save();
        }
    }

    /**
     * 使一个邀请码生效
     *
     * @param string $code
     */
    public static function enable($code) {
        $obj = AutoZPInviteCode::find($code);
        if (filled($obj)) {
            $obj->enabled = true;
            $obj->save();
        }
    }

    /**
     * 从 Cookie 中获取用户当前邀请码
     *
     * @return string|null
     */
    public static function getFromCookie() {
        $request = Request::input("invite_code");
        return Cookie::get(self::cookie_name, $request);
    }

    /**
     * 在 Cookie 中存储用户输入的邀请码
     *
     * @param string $code
     */
    public static function saveToCookie($code) {
        Cookie::queue(self::cookie_name, $code, self::cookie_time);
    }

    /**
     * 清除 Cookie 中存储的邀请码
     *
     * @return void
     */
    public static function clearCookie() {
        Cookie::queue(Cookie::forget(self::cookie_name));
    }
}
