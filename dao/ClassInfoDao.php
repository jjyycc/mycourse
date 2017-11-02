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
require_once(ROOT . "/model/ClassInfo.php");
require_once(ROOT . "/dao/BaseDAO.php");

use model\ClassInfo;

class ClassInfoDao extends BaseDAO
{

    /**
     * 新增一个班级信息
     * @param $aClassInfo
     * @return bool
     */
    public function newClassInfo($aClassInfo)
    {
        if ($aClassInfo == null) return false;
        if ($this->findClassInfoByCId($aClassInfo->getCId()) != null) return false;

        $sql = "insert into CourseInfo(id,cid,title,startdate,description,teaid,status,courseBH) values(uuid(), :cid,:title,:startdate,:description,:teaid,:status,:courseBH)";
        try {

            $statement = $this->getPDO()->prepare($sql);
            $statement->execute(array('cid' => $aClassInfo->getCId(),
                'title' => $aClassInfo->getTitle(),
                'startdate' => $aClassInfo->getStartdate(),
                'description' => $aClassInfo->getDescription(),
                'teaid'=>$aClassInfo->getTeaId(),
                'status'=>$aClassInfo->getStatus(),
                'courseBH'=>$aClassInfo->getCourseBH()));

            return $this->findClassInfoByCId($aClassInfo->getCId());
        } catch (\PDOException $e) {
            die('Error:' . $e->getMessage() . ".");
            return null;
        }


    }


    /**
     * 修改班级信息
     * @param $aClassInfo
     * @return bool|null
     */
    public function saveClassInfo($aClassInfo)
    {
        if ($aClassInfo == null) return null;
        if ($this->findClassInfoById($aClassInfo->getId()) == null) return null;
        $sql = "update ClassInfo set title=:title,description=:description,teaid=:teaid,status=:status,courseBH=:coursebh where id=:id";
        try {
            $statement = $this->getPDO()->prepare($sql);
            $statement->execute(array('mc' => $aClassInfo->getMC(),
                'title' => $aClassInfo->getTitle(),
                'description' => $aClassInfo->getDescription(),
                'teaid' => $aClassInfo->getTeaId(),
                'status'=>$aClassInfo->getStatus(),
                'coursebh'=>$aClassInfo->getCourseBH()));
            return true;
        } catch (\PDOException $e) {
            return false;
        }
    }

    /**
     * 根据指定的班级主键编号删除班级信息
     * @param $Id
     * @return bool
     */
    public function delCourseInfoById($Id)
    {
        $sql = "delete from ClassInfo where id=:id";
        try {
            $statement = $this->getPDO()->prepare($sql);
            $statement->execute(array('id' => $Id));
            return true;
        } catch (\PDOException $e) {
            return false;
        }
    }

    /**
     * 根据指定的班级编号删除班级信息
     * @param $bh
     * @return bool
     */
    public function delClassInfoByBH($cid)
    {
        $sql = "delete from ClassInfo where cid=:cid";
        try {
            $statement = $this->getPDO()->prepare($sql);
            $statement->execute(array('cid' => $cid));
            return true;
        } catch (\PDOException $e) {
            return false;
        }
    }

    /**
     * 删除指定的班级信息
     * @param $aClassInfo
     * @return bool|null
     */
    public function delClassInfo($aClassInfo)
    {
        if ($aClassInfo == null) return false;
        if ($this->findClassInfoById($aClassInfo->getId()) == null) return null;
        return $this->delClassInfoById($aClassInfo->getId());

    }

    /**设置绑架对象的属性值
     * @param $row
     * @return CourseInfo|null
     */
    private function getClassInfoValueObj($row)
    {

        if ($row == null) return null;
        $aClassInfo = new ClassInfo();
        $aClassInfo->setId($row['id']);
        $aClassInfo->setCId($row['cid']);
        $aClassInfo->setTitle($row['title']);
        $aClassInfo->setStartDate($row['startdate']);
        $aClassInfo->setDescription($row['description']);
        $aClassInfo->setTeaId($row['teaid']);
        $aClassInfo->setStatus($row['status']);
        $aClassInfo->setCourseBH($row['courseBH']);

        return $aClassInfo;
    }

    /**
     * 查询所有的班级信息
     * @return array
     */
    public function loadAllClassInfo()
    {
        $sql = "select * from ClassInfo order by cid ";

        $statement = self::getPDO()->prepare($sql);
        $statement->execute();
        $rows = $statement->fetchAll();

        $classInfoList = array();
        foreach ($rows as $r) {
            $aClassInfo = $this->getClassInfoValueObj($r);
            $classInfoList[] = $aClassInfo;
        }
        return $classInfoList;
    }

    /**
     * 根据指定的课程编号查询所有的班级信息
     * @return array
     */
    public function loadAllClassInfoBYCourseBH($courseBH)
    {
        $sql = "select * from ClassInfo where courseBH=:coursebh order by cid ";

        $statement = self::getPDO()->prepare($sql);
        $statement->execute(array('coursebh'=>$courseBH));
        $rows = $statement->fetchAll();

        $classInfoList = array();
        foreach ($rows as $r) {
            $aClassInfo = $this->getClassInfoValueObj($r);
            $classInfoList[] = $aClassInfo;
        }
        return $classInfoList;
    }

    /**
     * 根据课程主键编号查询课程信息
     * @param $id
     * @return CourseInfo|null
     */
    public function findClassInfoById($id)
    {
        $sql = "select * from ClassInfo WHERE id=:id";
        try {
            $statement = self::getPDO()->prepare($sql);
            $statement->execute(array('id' => $id));
            $rows = $statement->fetchAll();
            if ($rows != null && count($rows) > 0) {
                return $this->getClassInfoValueObj($rows[0]);
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
    public function findClassInfoByCId($cId)
    {
        $sql = "select * from classInfo where cid=$cId";

        $statement = $this->getPDO()->prepare($sql);
        $statement->execute();
        $rows = $statement->fetchAll();

        if ($rows != null && count($rows) > 0) {
            $aClassInfo = $this->getCourceInfoValueObj($rows[0]);
            return $aClassInfo;
        }
        return null;

    }

    /**
     * 将指定的学生加入到指定的班级中
     * @param $stuId
     * @param $clsId
     */

    public  function addStudentToClass($stuId,$clsId)
    {
        if ($this->findStudentInClass($stuId,$clsId)) return true;
        $sql='insert into stu2Class(id,stuId,clsId) values(uuid(),:stuid,:clsid)';
        $statement = $this->getPDO()->prepare($sql);
        try{
            $statement->execute(array('stuid'=>$stuId,'clsid'=>$clsId));
            return true;
        }catch (\PDOException $e)
        {
            die('error:'.$e->getMessage().'!');
            return false;
        }

    }
    private function findStudentInClass($stuId,$clsId){
        $sql = 'select * from stu2Class where stuId=:stuid and clsId =:clsid';
        $statement = $this->getPDO()->prepare($sql);
        try{
            $statement->execute(array('stuid'=>$stuId,'clsid'=>$clsId));
            $row=$statement->fetch();
            if($row != null) return true;
            return false;
        }catch (\PDOException $e)
        {
            die('error:'.$e->getMessage().'!');
            return false;
        }
    }
}

