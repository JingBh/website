<?php
namespace JingBh\AutoZP\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * @property string code (主键) 邀请码
 * @property boolean enabled 是否可用
 * @property Carbon updated_at
 * @property Carbon created_at
 */
class AutoZPInviteCode extends Model
{
    protected $table = "autozp_invite_code";

    protected $primaryKey = "code";

    public $incrementing = false;

    protected $keyType = "string";

    protected $casts = [
        "enabled" => "boolean"
    ];

    /**
     * 获取使用此邀请码的用户
     *
     * @return AutoZPUser
     */
    public function user() {
        return AutoZPUser::where([
            "invite_code" => $this->code
        ])->first();
    }
}
