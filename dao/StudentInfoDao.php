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
require_once(ROOT . "/model/StudentInfo.php");
require_once(ROOT . "/dao/BaseDAO.php");

use model\StudentInfo;

class StudentInfoDao extends BaseDAO
{

    /**
     * 新增一个学生信息
     * @param $aStudentInfo
     * @return bool
     */
    public function newStudentInfo($aStudentInfo)
    {
        if ($aStudentInfo == null) return false;
        if ($this->findStudentInfoByXH($aStudentInfo->getXh()) != null) return false;
        $id = $aStudentInfo->getId();
        $xh = $aStudentInfo->getXh();
        $xm = $aStudentInfo->getXm();
        $zy = $aStudentInfo->getZy();
        $xy = $aStudentInfo->getXy();
        $xb=$aStudentInfo->getXb();
        $bj=$aStudentInfo->getBj();
        $sql = "insert into StudentInfo(id,xh,bj,xm,zy,xy,xb) values(uuid(), :xh,:bj,:xm,:zy,:xy,:xb)";
        try {

            $statement = $this->getPDO()->prepare($sql);
            $statement->execute(array('xh' => $xh,'bj'=>$bj, 'xm' => $xm, 'zy' => $zy, 'xy' => $xy,'xb'=>$xb));

            return $this->findStudentInfoByXH($aStudentInfo->getXh());
        } catch (\PDOException $e) {
            die('Error:' . $e->getMessage() . ".");
            return null;
        }


    }


    /**
     * 修改学生信息
     * @param $aStudentInfo
     * @return bool|null
     */
    public function saveStudentInfo($aStudentInfo)
    {
        if ($aStudentInfo == null) return null;
        if ($this->findStudentInfoById($aStudentInfo->getId()) == null) return null;
        $sql = "update StudentInfo set xm=:xm,bj=:bj,zy=:zc,xy=:js,xb=:xb where id=:id";
        try {
            $statement = $this->getPDO()->prepare($sql);
            $statement->execute(array('xm' => $aStudentInfo->getXm(),
                'bj' => $aStudentInfo->getBj(),
                'zy' => $aStudentInfo->getZy(),
                'xy' => $aStudentInfo->getXy(),
                'xb' => $aStudentInfo->getXb(),
                'id' => $aStudentInfo->getId()));
            return true;
        } catch (\PDOException $e) {
            return false;
        }
    }

    /**
     * 根据指定的学生主键编号删除学生信息
     * @param $Id
     * @return bool
     */
    public function delStudentInfoById($Id)
    {
        $sql = "delete from StudentInfo where id=:id";
        try {
            $statement = $this->getPDO()->prepare($sql);
            $statement->execute(array('id' => $Id));
            return true;
        } catch (\PDOException $e) {
            return false;
        }
    }

    /**
     * 根据指定的学生学号号删除教学生信息
     * @param $gh
     * @return bool
     */
    public function delStudentInfoByBH($xh)
    {
        $sql = "delete from StudentInfo where xh=:xh";
        try {
            $statement = $this->getPDO()->prepare($sql);
            $statement->execute(array('xh' => $xh));
            return true;
        } catch (\PDOException $e) {
            return false;
        }
    }

    /**
     * 删除指定的学生信息
     * @param $aStudentInfo
     * @return bool|null
     */
    public function delStudentInfo($aStudentInfo)
    {
        if ($aStudentInfo == null) return false;
        if ($this->findStudentInfoById($aStudentInfo->getId()) == null) return null;
        return $this->delStudentInfoById($aStudentInfo->getId());

    }

    /**设置学生对象的属性值
     * @param $row
     * @return CourseInfo|null
     */
    private function getStudentInfoValueObj($row)
    {

        if ($row == null) return null;
        $aStudentInfo = new StudentInfo();
        $aStudentInfo->setId($row['id']);
        $aStudentInfo->setXh($row['xh']);
        $aStudentInfo->setBj($row['bj']);
        $aStudentInfo->setXm($row['xm']);
        $aStudentInfo->setZy($row['zy']);
        $aStudentInfo->setXy($row['xy']);
        $aStudentInfo->setXb($row['xb']);

        return $aStudentInfo;
    }

    /**
     * 查询所有的学生信息
     * @return array
     */
    public function loadStudentInfo()
    {
        $sql = "select * from StudentInfo order by xh ";

        $statement = self::getPDO()->prepare($sql);
        $statement->execute();
        $rows = $statement->fetchAll();

        $studentList = array();
        foreach ($rows as $r) {
            $aStudentInfo = $this->getStudentInfoValueObj($r);

            $studentList[] = $aStudentInfo;
        }
        return $studentList;
    }

    /**
     * 根据学生主键编号查询学生信息
     * @param $id
     * @return |null
     */
    public function findStudentInfoById($id)
    {
        $sql = "select * from StudentInfo WHERE id=:id";
        try {
            $statement = self::getPDO()->prepare($sql);
            $statement->execute(array('id' => $id));
            $rows = $statement->fetchAll();
            if ($rows != null && count($rows) > 0) {
                return $this->getStudentInfoValueObj($rows[0]);
            }
        } catch (\PDOException $e) {
            return null;
        }

    }


    /**
     * 根据学号查询学生信息
     * @param $xh
     * @return StudentInfo|null
     */
    public function findStudentInfoByXH($xh)
    {
        $sql = "select * from StudentInfo where xh=:xh";

        $statement = $this->getPDO()->prepare($sql);
        $statement->execute(array('xh'=>$xh));
        $rows = $statement->fetchAll();

        if ($rows != null && count($rows) > 0) {
            $aStudentInfo = $this->getStudentInfoValueObj($rows[0]);
            return $aStudentInfo;
        }
        return null;

    }
}

