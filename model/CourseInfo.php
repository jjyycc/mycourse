<?php
/**
 * Created by PhpStorm.
 * User: zj
 * Date: 2017/10/24
 * Time: 15:09
 */

namespace model;

class CourseInfo
{
    /**
     * @var 唯一主键
     */
    private  $_id;

    /**
     * @return 唯一主键
     */
    public function getId()
    {
        return $this->_id;
    }

    /**
     * @param 唯一主键 $id
     */
    public function setId($id)
    {
        $this->_id = $id;
    }

    /**
     * @var 课程编号
     */
    private $_BH;

    /**
     * @return 课程编号
     */
    public function getBH()
    {
        return $this->_BH;
    }

    /**
     * @param 课程编号 $BH
     */
    public function setBH($BH)
    {
        $this->_BH = $BH;
    }

    /**
     * @var 课程名称
     */
    private $_MC;

    /**
     * @return 课程名称
     */
    public function getMC()
    {
        return $this->_MC;
    }

    /**
     * @param 课程名称 $MC
     */
    public function setMC($MC)
    {
        $this->_MC = $MC;
    }

    /**
     * @var 课时数
     */
    private  $_KSS;

    /**
     * @var 课程介绍
     */
    private  $_KCJS;

    /**
     * @return 课程介绍
     */
    public function getKCJS()
    {
        return $this->_KCJS;
    }

    /**
     * @param 课程介绍 $KCJS
     */
    public function setKCJS($KCJS)
    {
        $this->_KCJS = $KCJS;
    }

    /**
     * @return 课时数
     */
    public function getKSS()
    {
        return $this->_KSS;
    }

    /**
     * @param 课时数 $KSS
     */
    public function setKSS($KSS)
    {
        $this->_KSS = $KSS;
    }

}