<?php
namespace JingBh\NCMRank;

use GuzzleHttp\Client;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\App;
use voku\helper\HtmlDomParser;

class NCMSpider
{
    protected const headers = [
        "User-Agent" => "Mozilla/5.0 JWS NcmRank",
        "Referer" => "https://music.163.com/"
    ];

    protected const base_url = "https://music.163.com/user/home";

    /**
     * 依次更新所有用户的数据
     */
    public static function updateAll() {
        $users = NCMUser::all();
        foreach ($users as $user) {
            self::updateData($user);
        }
    }

    /**
     * 爬取并更新一个用户的数据
     *
     * @param NCMUser $user
     */
    public static function updateData(NCMUser $user) {
        if (App::runningInConsole())
            print("Updating data for user {$user->name} ({$user->id}) ...\n");
        $date = self::date();
        $url = "?id=" . $user->id;
        $response = self::http()->get($url);
        if ($response->getStatusCode() == 200) {
            $body = (string) $response->getBody();
            $dom = HtmlDomParser::str_get_html($body);

            // 获取用户等级
            $user->level = $dom->find(".lev")[0]->text();

            // 获取用户名
            $user->name = $dom->find(".tit.f-ff2.s-fc0.f-thide")[0]->text();

            // 获取听歌数
            $pattern = '/听歌([0-9]*)首/';
            preg_match($pattern, $body, $matches);
            $total = $matches[1];

            // 获取头像
            $pattern = '/"images": \["(.+?)"\]/';
            $match = preg_match($pattern, $body, $matches);
            if ($match == 1) $user->avatar = $matches[1];

            $record = $user->records()
                ->where("date", $date->toDateString())
                ->first();
            if (empty($record)) {
                $record = new NCMRecord;
                $record->user = $user->id;
                $record->date = $date;
            }
            $record->updated_at = Carbon::now();
            $record->total = $user->total = $total;
            $record->save();
            $user->save();
        }
    }

    /**
     * 创建一个GuzzleHttp客户端实例
     *
     * @return Client
     */
    protected static function http() {
        $options = [
            "base_uri" => self::base_url,
            "connect_timeout" => 30,
            "headers" => self::headers,
            "timeout" => 30
        ];
        return new Client($options);
    }

    /**
     * 获取当前日期
     *
     * 在第二天0点时调用算作前一天，
     * 以此来计算前一天听歌量总和
     *
     * @return Carbon
     */
    protected static function date() {
        $now = now();
        if ($now->hour == 0) $now->second -= 3601;
        return $now;
    }

}
