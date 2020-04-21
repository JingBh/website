<?php
namespace JingBh\AutoZP;

class Attachment
{
    /**
     * 处理附件列表
     *
     * @param array $list
     * @return array
     */
    public static function parseAttachmentsList($list) {
        $result = [];
        foreach ($list as $item) {
            $name = self::parseAttachment($item);
            if (filled($name)) {
                if (!in_array($name, $result)) // 去重
                    array_push($result, $name);
            }
        }
        return $result;
    }

    /**
     * 处理单个附件地址
     *
     * @param string $url
     * @return null|string
     */
    public static function parseAttachment($url) {
        $match = preg_match('/\/file\/([0-9a-f\-].*\..*)/', $url, $matches);
        return $match ? $matches[1] : null;
    }
}
