<?php
namespace JingBh\AutoZP\Traits;

use JingBh\AutoZP\SchoolsId;

trait StudentInfo
{
    /**
     * 获取学生所在学校
     *
     * @return string
     */
    public function getSchool() {
        $userInfo = $this->updateUserInfo();
        if (filled($userInfo)) {
            $schoolRaw = $userInfo["orgName"];
            $school = str_replace("主校区", "", $schoolRaw);
            return trim($school);
        } else return "";
    }

    /**
     * 获取学校ID
     * 不一定成功
     *
     * @return null|string
     */
    public function getSchoolId() {
        $school = $this->getSchool();
        $info = SchoolsId::get($school);
        return $info["id"];
    }

    /**
     * 获取学年与学期信息
     * 以及一些其它乱七八糟的信息
     *
     * @return array
     */
    public function getTermInfo() {
        $userInfo = $this->updateUserInfo();
        $classInfo = $this->getClass();
        if (filled($userInfo)) {
            return [
                "orgId" => $userInfo["orgId"],
                "gradeId" => $userInfo["gradeId"],
                "classId" => $classInfo["id"],
                "class" => $classInfo["name"],
                "yearId" => $userInfo["schoolyearId"],
                "year" => $userInfo["schoolyearName"],
                "semesterId" => $userInfo["schoolsemesterId"],
                "semester" => $userInfo["schoolsemesterName"]
            ];
        } else return [];
    }

    /**
     * 获取班级信息
     *
     * @return array
     */
    public function getClass() {
        $userInfo = $this->updateUserInfo();
        if (filled($userInfo)) {
            return $userInfo["classList"][0];
        } else return [];
    }

    /**
     * 获取入学年份
     * 不一定成功
     *
     * @return null|int
     */
    public function getGradeYear() {
        $classInfo = $this->getClass();
        $match = preg_match('/([0-9]*)级/', $classInfo["name"], $matches);
        return $match == 1 ? intval($matches[1]) : null;
    }
}
