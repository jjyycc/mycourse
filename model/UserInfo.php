<?php
/**
 * Created by PhpStorm.
 * User: zj
 * Date: 2017/10/30
 * Time: 11:00
 */

namespace model;


class UserInfo
{
    private $_Id;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->_Id;
    }

    /**
     * @param mixed $Id
     */
    public function setId($Id)
    {
        $this->_Id = $Id;
    }
    private $_Username;

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->_Username;
    }

    /**
     * @param mixed $Username
     */
    public function setUsername($Username)
    {
        $this->_Username = $Username;
    }
    private $_PW;

    /**
     * @return mixed
     */
    public function getPW()
    {
        return $this->_PW;
    }

    /**
     * @param mixed $PW
     */
    public function setPW($PW)
    {
        $this->_PW = $PW;
    }

    private $_Role;

    /**
     * @return mixed
     */
    public function getRole()
    {
        return $this->_Role;
    }

    /**
     * @param mixed $Role
     */
    public function setRole($Role)
    {
        $this->_Role = $Role;
    }
    private $_PId;

    /**
     * @return mixed
     */
    public function getPId()
    {
        return $this->_PId;
    }

    /**
     * @param mixed $PId
     */
    public function setPId($PId)
    {
        $this->_PId = $PId;
    }

    private $_People;

    /**
     * @return mixed
     */
    public function getPeople()
    {
        return $this->_People;
    }

    /**
     * @param mixed $People
     */
    public function setPeople($People)
    {
        $this->_People = $People;
    }

}