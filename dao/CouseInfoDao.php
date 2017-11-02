<?php
/**
 * Created by PhpStorm.
 * User: zj
 * Date: 2017/10/24
 * Time: 15:39
 */

namespace dao;
require_once('../base.php');
//dirname(__FILE__).'/' 当前文件所在路径
require_once(ROOT . "/model/CourseInfo.php");
require_once(ROOT . "/dao/BaseDAO.php");

use model\CourseInfo;

class CouseInfoDao extends BaseDAO
{

    /**
     * 新增一个课程信息
     * @param $aCourseInfo
     * @return bool
     */
    public function newCourseInfo($aCourseInfo)
    {
        if ($aCourseInfo == null) return false;
        if ($this->findCourseInfoByBH($aCourseInfo->getBH()) != null) return false;
        $id = $aCourseInfo->getId();
        $bh = $aCourseInfo->getBH();
        $mc = $aCourseInfo->getMC();
        $kss = $aCourseInfo->getKSS();
        $kcjs = $aCourseInfo->getKCJS();
        $sql = "insert into CourseInfo(id,bh,mc,kss,kcjs) values(uuid(), :bh,:mc,:kss,:kcjs)";
        try {

            $statement = $this->getPDO()->prepare($sql);
            $statement->execute(array('bh' => $bh, 'mc' => $mc, 'kss' => $kss, 'kcjs' => $kcjs));

            return $this->findCourseInfoByBH($aCourseInfo->getBH());
        } catch (\PDOException $e) {
            die('Error:' . $e->getMessage() . ".");
            return null;
        }


    }


    /**
     * 修改课程信息
     * @param $aCourseInfo
     * @return bool|null
     */
    public function saveCourseInfo($aCourseInfo)
    {
        if ($aCourseInfo == null) return null;
        if ($this->findCourseInfoById($aCourseInfo->getId()) == null) return null;
        $sql = "update CourseInfo set mc=:mc,kss=:kss,kcjs=:kcjs where id=:id";
        try {
            $statement = $this->getPDO()->prepare($sql);
            $statement->execute(array('mc' => $aCourseInfo->getMC(),
                'kss' => $aCourseInfo->getKSS(),
                'kcjs' => $aCourseInfo->getKCJS(),
                'id' => $aCourseInfo->getId()));
            return true;
        } catch (\PDOException $e) {
            return false;
        }
    }

    /**
     * 根据指定的课程主键编号删除课程信息
     * @param $Id
     * @return bool
     */
    public function delCourseInfoById($Id)
    {
        $sql = "delete from CourseInfo where id=:id";
        try {
            $statement = $this->getPDO()->prepare($sql);
            $statement->execute(array('id' => $Id));
            return true;
        } catch (\PDOException $e) {
            return false;
        }
    }

    /**
     * 根据指定的课程逻辑编号删除课程信息
     * @param $bh
     * @return bool
     */
    public function delCourseInfoByBH($bh)
    {
        $sql = "delete from CourseInfo where bh=:bh";
        try {
            $statement = $this->getPDO()->prepare($sql);
            $statement->execute(array('bh' => $bh));
            return true;
        } catch (\PDOException $e) {
            return false;
        }
    }

    /**
     * 删除指定的课程信息
     * @param $aCourseInfo
     * @return bool|null
     */
    public function delCourseInfo($aCourseInfo)
    {
        if ($aCourseInfo == null) return false;
        if ($this->findCourseInfoById($aCourseInfo->getId()) == null) return null;
        return $this->delCourseInfoById($aCourseInfo->getId());

    }

    /**设置课程对象的属性值
     * @param $row
     * @return CourseInfo|null
     */
    private function getCourceInfoValueObj($row)
    {

        if ($row == null) return null;
        $aCourseInfo = new CourseInfo();
        $aCourseInfo->setId($row['id']);
        $aCourseInfo->setBH($row['bh']);
        $aCourseInfo->setMC($row['mc']);
        $aCourseInfo->setKSS($row['kss']);
        $aCourseInfo->setKCJS($row['kcjs']);

        return $aCourseInfo;
    }

    /**
     * 查询所有的课程信息
     * @return array
     */
    public function loadAllCourseInfo()
    {
        $sql = "select * from CourseInfo order by bh ";

        $statement = self::getPDO()->prepare($sql);
        $statement->execute();
        $rows = $statement->fetchAll();

        $courseList = array();
        foreach ($rows as $r) {
            $aCourseInfo = $this->getCourceInfoValueObj($r);

            $courseList[] = $aCourseInfo;
        }
        return $courseList;
    }

    /**
     * 根据课程主键编号查询课程信息
     * @param $id
     * @return CourseInfo|null
     */
    public function findCourseInfoById($id)
    {
        $sql = "select * from CourseInfo WHERE id=:id";
        try {
            $statement = self::getPDO()->prepare($sql);
            $statement->execute(array('id' => $id));
            $rows = $statement->fetchAll();
            if ($rows != null && count($rows) > 0) {
                return $this->getCourceInfoValueObj($rows[0]);
            }
        } catch (\PDOException $e) {
            return null;
        }

    }


    /**
     * 根据课程编号查询课程信息
     * @param $bh
     * @return CourseInfo|null
     */
    public function findCourseInfoByBH($bh)
    {
        $sql = "select * from CourseInfo where bh=$bh";

        $statement = $this->getPDO()->prepare($sql);
        $statement->execute();
        $rows = $statement->fetchAll();

        if ($rows != null && count($rows) > 0) {
            $aCourseInfo = $this->getCourceInfoValueObj($rows[0]);
            return $aCourseInfo;
        }
        return null;

    }
}

