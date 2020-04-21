<?php
namespace JingBh\AutoZP\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * @property string id 教育ID
 * @property AutoZPInviteCode invite_code 使用的邀请码
 * @property string|null password 保存的密码
 * @property Carbon updated_at
 * @property Carbon created_at
 */
class AutoZPUser extends Model
{
    protected $table = "autozp_user";

    public $incrementing = false;

    protected $keyType = "string";

    public function getPasswordAttribute($value) {
        return decrypt($value);
    }

    public function setPasswordAttribute($value) {
        $this->attributes["password"] = filled($value) ? encrypt($value) : null;
    }

    /**
     * 获取当前使用的邀请码
     *
     * @param string $value
     * @return AutoZPInviteCode
     */
    public function getInviteCodeAttribute($value) {
        $obj = AutoZPInviteCode::where([
            ["code", "=", $value],
            ["enabled", "=", true]
        ])->get();
        return empty($obj) ? null : $obj->code;
    }
}
