<?php
/**
 * Created by PhpStorm.
 * User: zj
 * Date: 2017/10/30
 * Time: 10:33
 */

namespace model;

/**
 * 班级信息类
 * Class ClassInfo
 * @package model
 */
class ClassInfo
{
    private  $_Id;

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
    private $_CId;

    /**
     * @return mixed
     */
    public function getCId()
    {
        return $this->_CId;
    }

    /**
     * @param mixed $CId
     */
    public function setCId($CId)
    {
        $this->_CId = $CId;
    }
    private $_Title;

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->_Title;
    }

    /**
     * @param mixed $Title
     */
    public function setTitle($Title)
    {
        $this->_Title = $Title;
    }
    private  $_StartDate;

    /**
     * @return mixed
     */
    public function getStartDate()
    {
        return $this->_StartDate;
    }

    /**
     * @param mixed $StartDate
     */
    public function setStartDate($StartDate)
    {
        $this->_StartDate = $StartDate;
    }
    private $_Description;

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->_Description;
    }

    /**
     * @param mixed $Description
     */
    public function setDescription($Description)
    {
        $this->_Description = $Description;
    }
    private  $_TeaId;

    /**
     * @return mixed
     */
    public function getTeaId()
    {
        return $this->_TeaId;
    }

    /**
     * @param mixed $TeaId
     */
    public function setTeaId($TeaId)
    {
        $this->_TeaId = $TeaId;
    }
    private $_Status;

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->_Status;
    }

    /**
     * @param mixed $Status
     */
    public function setStatus($Status)
    {
        if($Status==0 || $Status==1) {
            $this->_Status = $Status;
        }else {
            throw new \Exception('输入值错误！必须是0（未开班）或是1（已开班）');
        }
    }

    private $_CourseBH;

    /**
     * @return mixed
     */
    public function getCourseBH()
    {
        return $this->_CourseBH;
    }

    /**
     * @param mixed $CourseBH
     */
    public function setCourseBH($CourseBH)
    {
        $this->_CourseBH = $CourseBH;
    }

}