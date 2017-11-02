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
require_once(ROOT . "/model/UserInfo.php");
require_once(ROOT . "/dao/BaseDAO.php");

require_once(ROOT . "/model/TeacherInfo.php");
require_once(ROOT . "/dao/TeacherInfoDAO.php");

require_once(ROOT . "/model/StudentInfo.php");
require_once(ROOT . "/dao/StudentInfoDao.php");
use model\UserInfo;

class UserInfoDao extends BaseDAO
{

    /**
     * 新增一个用户帐号信息
     * @param $aUserInfo
     * @return bool
     */
    public function newUserInfo($aUserInfo)
    {
        if ($aUserInfo == null) return false;
        if ($this->findUserInfoByUserName($aUserInfo->getUsername()) != null) return false;
        $id = $aUserInfo->getId();
        $username = $aUserInfo->getUsername();
        $pw = $aUserInfo->getPW();
        $role = $aUserInfo->getRole();
        $pid = $aUserInfo->getPId();

        $sql = "insert into userinfo(id,username,pw,role,pid) values(uuid(), :username,:pw,:role,:pid)";
        try {

            $statement = $this->getPDO()->prepare($sql);
            $statement->execute(array('username' => $username,'pw'=>$pw, 'role' => $role, 'pid' => $pid));

            return $this->findUserInfoByUserName($aUserInfo->getUsername());
        } catch (\PDOException $e) {
            die('Error:' . $e->getMessage() . ".");
            return null;
        }


    }


    /**
     * 修改用户信息
     * @param $aUserInfo
     * @return bool|null
     */
    public function setUserPW($aUserInfo)
    {
        if ($aUserInfo == null) return null;
        if ($this->findUserInfoById($aUserInfo->getId) == null) return null;
        $sql = "update Userinfo set pw=:pw where id=:id";
        try {
            $statement = $this->getPDO()->prepare($sql);
            $statement->execute(array('pw' => $aUserInfo->getPW(),
                'id' => $aUserInfo->getId()));
            return true;
        } catch (\PDOException $e) {
            return false;
        }
    }

    /**
     * 根据指定的用户账号删除用户帐号信息
     * @param $Id
     * @return bool
     */
    public function delUserInfoById($Id)
    {
        $sql = "delete from Userinfo where id=:id and username<>'admin'";
        try {
            $statement = $this->getPDO()->prepare($sql);
            $statement->execute(array('id' => $Id));
            return true;
        } catch (\PDOException $e) {
            return false;
        }
    }



    /**设置用户对象的属性值
     * @param $row
     * @return CourseInfo|null
     */
    private function getUserInfoValueObj($row)
    {

        if ($row == null) return null;
        $aUserInfo = new UserInfo();
        $aUserInfo->setId($row['id']);
        $aUserInfo->setUsername($row['username']);
        $aUserInfo->setPW($row['pw']);
        $aUserInfo->setRole($row['role']);
        $aUserInfo->setPId($row['pid']);


        return $aUserInfo;
    }

    /**
     * 查询所有的学生信息
     * @return array
     */
    public function loadUserInfo()
    {
        $sql = "select * from Userinfo order by username ";

        $statement = self::getPDO()->prepare($sql);
        $statement->execute();
        $rows = $statement->fetchAll();

        $userList = array();
        foreach ($rows as $r) {
            $aUserInfo = $this->getUserInfoValueObj($r);

            $userList[] = $aUserInfo;
        }
        return $userList;
    }

    /**
     * 根据学生主键编号查询学生信息
     * @param $id
     * @return |null
     */
    public function findUserInfoById($id)
    {
        $sql = "select * from Userinfo WHERE id=:id";
        try {
            $statement = self::getPDO()->prepare($sql);
            $statement->execute(array('id' => $id));
            $rows = $statement->fetchAll();
            if ($rows != null && count($rows) > 0) {
                return $this->getUserInfoValueObj($rows[0]);
            }
        } catch (\PDOException $e) {
            return null;
        }

    }


    /**
     * 根据学号查询学生信息
     * @param $username
     * @return UserInfo|null
     */
    public function findUserInfoByUserName($username)
    {
        $sql = "select * from Userinfo where username=:username";

        $statement = $this->getPDO()->prepare($sql);
        $statement->execute(array('username'=>$username));
        $rows = $statement->fetchAll();

        if ($rows != null && count($rows) > 0) {
            $aUserInfo = $this->getUserInfoValueObj($rows[0]);
            switch ($aUserInfo->getRole()){
                case 'admin':
                    break;
                case 'teacher':
                    $aTeacherdao=new \dao\TeacherInfoDao();
                    $aTeacher =$aTeacherdao->findTeacherInfoById($aUserInfo->getPId());
                    $aUserInfo->setPeople($aTeacher);
                    break;
                case 'student':
                    $aStudentdao=new \dao\StudentInfoDao();
                    $aStudent =$aStudentdao->findStudentInfoById($aUserInfo->getPId());
                    $aUserInfo->setPeople($aStudent);
                    break;
            }
            return $aUserInfo;
        }
        return null;

    }
}


//test_CreatePDO();