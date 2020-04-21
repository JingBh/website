<?php
namespace JingBh\AutoZP;

/**
 * 学校ID数据库
 *
 * @link http://211.153.82.39/usercenter/
 */
class SchoolsId
{
    /**
     * 获取学校ID
     *
     * @param string $name 学校名称
     * @param null|string $district 区号，如海淀区为 110108
     * @return array
     */
    public static function get($name, $district=null) {
        $data = self::loadDatabase();
        foreach ($data as $data_district => $schools) {
            if (blank($district) || $district == $data_district)
                foreach ($schools as $id => $school) {
                    if ($name == $school) return [
                        "id" => $id,
                        "district" => $data_district,
                        "school" => $school
                    ];
                }
        }
        return [
            "id" => null,
            "district" => $district,
            "school" => $name
        ];
    }

    /**
     * 加载数据库
     *
     * @return array|null
     */
    protected static function loadDatabase() {
        $path = realpath(__DIR__ . "/../database/schoolsId.json");
        return json_decode(file_get_contents($path), true);
    }
}
