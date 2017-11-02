<?php
/**
 * Created by PhpStorm.
 * User: zj
 * Date: 2017/10/31
 * Time: 21:26
 */
require_once('../base.php');

require_once(ROOT . '/model/UserInfo.php');
require_once(ROOT . '/dao/UserInfoDao.php');

use model\UserInfo;
use dao\UserInfoDao;

function userLogin($username, $password)
{
    $dao = new dao\UserInfoDao();

    $aUser = $dao->findUserInfoByUserName($username);
    if (isset($aUser)) {
        if ($password == $aUser->getPW()) {
            return true;
        }
    } else {
        return false;
    }
}

$username='admin';

if (isset($username)) {
    if (userLogin($username, 'admin')) {
        echo '用户验证通过！';
    }
} else {
    // echo 'not ok';
    echo '用户验证失败！';
}