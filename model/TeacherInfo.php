<?php
/**
 * Created by PhpStorm.
 * User: zj
 * Date: 2017/10/28
 * Time: 16:05
 */

namespace model;


class TeacherInfo
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
    private $_gh;

    /**
     * @return mixed
     */
    public function getGh()
    {
        return $this->_gh;
    }

    /**
     * @param mixed $gh
     */
    public function setGh($gh)
    {
        $this->_gh = $gh;
    }
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
    private $_zc;

    /**
     * @return mixed
     */
    public function getZc()
    {
        return $this->_zc;
    }

    /**
     * @param mixed $zc
     */
    public function setZc($zc)
    {
        $this->_zc = $zc;
    }
    private $_js;

    /**
     * @return mixed
     */
    public function getJs()
    {
        return $this->_js;
    }

    /**
     * @param mixed $js
     */
    public function setJs($js)
    {
        $this->_js = $js;
    }

}