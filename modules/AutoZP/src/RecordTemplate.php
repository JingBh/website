<?php
namespace JingBh\AutoZP;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;

/**
 * 记录的类别及模板
 */
class RecordTemplate
{
    /**
     * 缓存时长
     * 当前为一周
     *
     * @var int
     */
    const cacheTime = 60 * 60 * 24 * 7;

    /**
     * @var AutoZPUser
     */
    protected $user;

    /**
     * @var string
     */
    protected $cacheKey;

    /**
     * @param AutoZPUser|string|null $user
     */
    public function __construct($user=null) {
        if (is_a($user, AutoZPUser::class)) {
            $this->user = $user;
        } elseif (is_string($user)) {
            $this->user = new AutoZPUser($user);
        } else $this->user = AutoZPUser::getTokenFromSession();
        $this->user->updateUserInfo();
        $this->cacheKey = "autozp_template_list_" . $this->user->userId;
    }

    public function getList() {
        return Cache::get($this->cacheKey) ?? $this->updateList();
    }

    public function updateList() {
        $response = WebSpider::getTemplateList($this->user->token);
        $result = [];
        try {
            foreach ($response["data"] as $item) {
                $templates = [];
                foreach ($item["recordtemplateVos"] as $templateItem) {
                    Arr::forget($templateItem, "id");
                    $templates[$templateItem["id"]] = $templateItem;
                }
                $result[$item["id"]] = [
                    "name" => $item["name"],
                    "templates" => $templates
                ];
            }
        } catch (\Throwable $e) {
            $result = [];
        }
        if (filled($result))
            Cache::put($this->cacheKey, $result, self::cacheTime);
        return $result;
    }
}
