<?php
/**
 * Created by PhpStorm.
 * User: zj
 * Date: 2017/10/30
 * Time: 9:53
 */

namespace model;


class StudentInfo
{
    /**主键编号
     * @var
     */
    private  $_id;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->_id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->_id = $id;
    }

    /**
     * 学号
     * @var
     */
    private $_xh;

    /**
     * @return mixed
     */
    public function getXh()
    {
        return $this->_xh;
    }

    /**
     * @param mixed $xh
     */
    public function setXh($xh)
    {
        $this->_xh = $xh;
    }

    /**
     * 姓名
     * @var
     */
    private $_xm;

    /**
     * @return mixed
     */
    public function getXm()
    {
        return $this->_xm;
    }

    /**
     * @param mixed $xm
     */
    public function setXm($xm)
    {
        $this->_xm = $xm;
    }

    /**
     * 班级(行政班)
     * @var
     */
    private  $_bj;

    /**
     * @return mixed
     */
    public function getBj()
    {
        return $this->_bj;
    }

    /**
     * @param mixed $bj
     */
    public function setBj($bj)
    {
        $this->_bj = $bj;
    }

    /**
     * 专业
     * @var
     */
    private $_zy;

    /**
     * @return mixed
     */
    public function getZy()
    {
        return $this->_zy;
    }

    /**
     * @param mixed $zy
     */
    public function setZy($zy)
    {
        $this->_zy = $zy;
    }

    /**
     * 学院
     * @var
     */
    private $_xy;

    /**
     * @return mixed
     */
    public function getXy()
    {
        return $this->_xy;
    }

    /**
     * @param mixed $xy
     */
    public function setXy($xy)
    {
        $this->_xy = $xy;
    }


    /**
     * 性别
     * @var
     */
    private $_xb;

    /**
     * @return mixed
     */
    public function getXb()
    {
        return $this->_xb;
    }

    /**
     * @param mixed $xb
     */
    public function setXb($xb)
    {
        $this->_xb = $xb;
    }



}