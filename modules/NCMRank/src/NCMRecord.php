<?php
namespace JingBh\NCMRank;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * @property int id
 * @property int user
 * @property Carbon date
 * @property string day
 * @property int total
 * @property Carbon updated_at
 */
class NCMRecord extends Model
{
    public $timestamps = false;

    protected $table = "ncm_records";

    /**
     * 格式化最后更新时间
     *
     * @param Carbon|string $value
     * @return string
     */
    public function getUpdatedAtAttribute($value) {
        $date = NCMRank::localizedCarbon($value);
        return $date->isoFormat("LL LTS");
    }

    /**
     * 这是哪一天的记录
     *
     * @return string
     */
    public function getDayAttribute() {
        $date = NCMRank::localizedCarbon($this->date);
        return $date->isoFormat("MMMDo");
    }

    /**
     * 这是哪一周的记录
     *
     * @return string
     */
    public function getWeekAttribute() {
        $date = NCMRank::localizedCarbon($this->date);
        return $date->isoFormat("YY年第w周");
    }
}