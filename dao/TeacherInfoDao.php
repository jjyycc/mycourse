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
require_once(ROOT . "/model/TeacherInfo.php");
require_once(ROOT . "/dao/BaseDAO.php");

use model\TeacherInfo;

class TeacherInfoDao extends BaseDAO
{

    /**
     * 新增一个教师信息
     * @param $aTeacherInfo
     * @return bool
     */
    public function newTeacherInfo($aTeacherInfo)
    {
        if ($aTeacherInfo == null) return false;
        if ($this->findTeacherInfoByGH($aTeacherInfo->getGh()) != null) return false;
        $id = $aTeacherInfo->getId();
        $gh = $aTeacherInfo->getGh();
        $xm = $aTeacherInfo->getXm();
        $zc = $aTeacherInfo->getZc();
        $js = $aTeacherInfo->getJs();
        $sql = "insert into TeacherInfo(id,gh,xm,zc,js) values(uuid(), :gh,:xm,:zc,:js)";
        try {

            $statement = $this->getPDO()->prepare($sql);
            $statement->execute(array('gh' => $gh, 'xm' => $xm, 'zc' => $zc, 'js' => $js));

            return $this->findTeacherInfoByGH($aTeacherInfo->getGh());
        } catch (\PDOException $e) {
            die('Error:' . $e->getMessage() . ".");
            return null;
        }


    }


    /**
     * 修改教师信息
     * @param $aTeacherInfo
     * @return bool|null
     */
    public function saveTeacherInfo($aTeacherInfo)
    {
        if ($aTeacherInfo == null) return null;
        if ($this->findTeacherInfoById($aTeacherInfo->getId()) == null) return null;
        $sql = "update TeacherInfo set xm=:xm,zc=:zc,js=:js where id=:id";
        try {
            $statement = $this->getPDO()->prepare($sql);
            $statement->execute(array('xm' => $aTeacherInfo->getXm(),
                'zc' => $aTeacherInfo->getZc(),
                'js' => $aTeacherInfo->getJs(),
                'id' => $aTeacherInfo->getId()));
            return true;
        } catch (\PDOException $e) {
            return false;
        }
    }

    /**
     * 根据指定的教师主键编号删除教师信息
     * @param $Id
     * @return bool
     */
    public function delTeacherInfoById($Id)
    {
        $sql = "delete from TeacherInfo where id=:id";
        try {
            $statement = $this->getPDO()->prepare($sql);
            $statement->execute(array('id' => $Id));
            return true;
        } catch (\PDOException $e) {
            return false;
        }
    }

    /**
     * 根据指定的教师逻辑编号删除教师信息
     * @param $gh
     * @return bool
     */
    public function delTeacherInfoByBH($gh)
    {
        $sql = "delete from TeacherInfo where gh=:gh";
        try {
            $statement = $this->getPDO()->prepare($sql);
            $statement->execute(array('gh' => $gh));
            return true;
        } catch (\PDOException $e) {
            return false;
        }
    }

    /**
     * 删除指定的课程信息
     * @param $aTeacherInfo
     * @return bool|null
     */
    public function delTeacherInfo($aTeacherInfo)
    {
        if ($aTeacherInfo == null) return false;
        if ($this->findTeacherInfoById($aTeacherInfo->getId()) == null) return null;
        return $this->delTeacherInfoById($aTeacherInfo->getId());

    }

    /**设置课程对象的属性值
     * @param $row
     * @return CourseInfo|null
     */
    private function getTeacherInfoValueObj($row)
    {

        if ($row == null) return null;
        $aTeacherInfo = new TeacherInfo();
        $aTeacherInfo->setId($row['id']);
        $aTeacherInfo->setGh($row['gh']);
        $aTeacherInfo->setXm($row['xm']);
        $aTeacherInfo->setZc($row['zc']);
        $aTeacherInfo->setJs($row['js']);

        return $aTeacherInfo;
    }

    /**
     * 查询所有的课程信息
     * @return array
     */
    public function loadAllTeacherInfo()
    {
        $sql = "select * from TeacherInfo order by gh ";

        $statement = self::getPDO()->prepare($sql);
        $statement->execute();
        $rows = $statement->fetchAll();

        $teacherList = array();
        foreach ($rows as $r) {
            $ateacherInfo = $this->getTeacherInfoValueObj($r);

            $teacherList[] = $ateacherInfo;
        }
        return $teacherList;
    }

    /**
     * 根据课程主键编号查询课程信息
     * @param $id
     * @return CourseInfo|null
     */
    public function findTeacherInfoById($id)
    {
        $sql = "select * from Teacher WHERE id=:id";
        try {
            $statement = self::getPDO()->prepare($sql);
            $statement->execute(array('id' => $id));
            $rows = $statement->fetchAll();
            if ($rows != null && count($rows) > 0) {
                return $this->getTeacherInfoValueObj($rows[0]);
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
    public function findTeacherInfoByGH($gh)
    {
        $sql = "select * from TeacherInfo where gh=:gh";

        $statement = $this->getPDO()->prepare($sql);
        $statement->execute(array('gh'=>$gh));
        $rows = $statement->fetchAll();

        if ($rows != null && count($rows) > 0) {
            $aTeacherInfo = $this->getTeacherInfoValueObj($rows[0]);
            return $aTeacherInfo;
        }
        return null;

    }
}



//test_CreatePDO();