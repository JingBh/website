<?php
namespace JingBh\NCMRank;

use Illuminate\Support\Carbon;

class NCMRank
{
    const levelup_need = [
        1 => 10,
        2 => 40,
        3 => 70,
        4 => 130,
        5 => 200,
        6 => 400,
        7 => 1000,
        8 => 3000,
        9 => 8000,
        10 => 20000
    ];

    const limit = 7 * 20 + 1;  // 获取的记录数量

    /**
     * 获取用户统计数据
     *
     * @param NCMUser $user
     * @return array
     */
    public static function analysis(NCMUser $user) {
        $data = ["user" => $user];

        $records_raw = $user->records()->orderBy("date")->get();
        if (count($records_raw) <= 1)
            abort(200, "Please try again tomorrow.");
        $total = $user->total;

        // 用户已注册天数
        $reg_days = $user->reg_days;
        $data["regDays"] = $reg_days;

        // 升级剩余听歌数
        $remain = max(0, $user->level == 10 ? 0 :
            self::levelup_need[$user->level + 1] - $user->total);
        $data["remain"] = $remain;

        // 注册以来平均听歌量
        [$data["averageReg"], $data["remainDaysReg"]] =
            self::calculateAverage([], $remain, $reg_days, $total);

        $records = []; // 全部记录
        $records_month = []; // 一个月内记录
        $records_week = []; // 一周内记录
        $records_by_week = []; // 按周记录
        $last = null;

        foreach ($records_raw as $record) {
            if (isset($last->total)) {
                $day = $record->day;
                $week = $record->week;

                $time_diff = Carbon::parse($record->date)->diffInSeconds();

                $records[$day] = $number = $record->total - $last->total;

                $data["recordsRaw"][$day] = $record->total;

                if (isset($records_by_week[$week])) {
                    $records_by_week[$week] += $number;
                } else $records_by_week[$week] = $number;

                if ($time_diff <= 604800) $records_week[$day] = $number;
                if ($time_diff <= 2592000) $records_month[$day] = $number;
            }
            $last = $record;
        }

        $data["lastUpdateTime"] = $last->updated_at;

        $data["records"] = $records;

        // 计算平均每周听歌量
        $data["recordsByWeek"] = $records_by_week;
        $data["averageByWeek"] = self::calculateAverage($records_by_week)[0];

        // 计算总日均听歌量
        [$data["averageAll"], $data["remainDaysAll"]] =
            self::calculateAverage($records, $remain);

        // 计算月日均听歌量
        [$data["averageMonth"], $data["remainDaysMonth"]] =
            self::calculateAverage($records_month, $remain);

        // 计算周日均听歌量
        [$data["averageWeek"], $data["remainDays"]] =
            self::calculateAverage($records_week, $remain);

        return $data;
    }

    /**
     * 根据用户ID获取统计数据
     *
     * @param string $id
     * @return array
     */
    public static function analysisById($id) {
        $user = NCMUser::find($id);
        if (empty($user)) return [];
        return self::analysis($user);
    }

    /**
     * @param array $numbers
     * @param int|null $remain
     * @param int|null $days
     * @param int|null $sum
     * @param int $digits
     * @return array
     */
    protected static function calculateAverage($numbers,
        $remain=null, $days=null, $sum=null, $digits=1) {
        $s = $sum ?? 0;
        $d = $days ?? 0;
        foreach ($numbers as $number) {
            if (empty($sum)) $s += $number;
            if (empty($days)) $d ++;
        }
        $average = $s / $d;
        if (filled($remain)) {
            if ($average == 0) {
                if ($remain == 0) {
                    $remain_days = 0;
                } else $remain_days = "无数";
            } else $remain_days = $remain / $average;
        } else $remain_days = null;
        $average = round($average, $digits);
        if (is_float($remain_days))
            $remain_days = round($remain_days, $digits);
        return [$average, $remain_days];
    }
}
