<?php
namespace JingBh\NCMRank;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * @property int id
 * @property string name
 * @property string avatar
 * @property int level
 * @property int total
 * @property Carbon reg_time
 * @property int reg_days 已注册天数
 */
class NCMUser extends Model
{
    public $timestamps = false;

    protected $table = "ncm_users";

    /**
     * 获取此用户的听歌数记录
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function records() {
        return $this->hasMany(NCMRecord::class, "user");
    }

    /**
     * 获取此用户已注册天数
     * @return int|null
     */
    public function getRegDaysAttribute() {
        if (filled($this->reg_time)) {
            return Carbon::parse($this->reg_time)
                    ->diffInDays() + 1;
        } else return null;
    }
}
