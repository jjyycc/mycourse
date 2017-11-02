<html>
<head>
    <meta charset="gbk"/>
    <title>用户登录</title>
</head>
<body>

<?php
require_once('../base.php');

require_once(ROOT . '/model/UserInfo.php');
require_once(ROOT . '/dao/UserInfoDao.php');

use model\UserInfo;
use dao\UserInfoDao;

function userLogin($username, $password)
{
    $dao = new dao\UserInfoDao();

    //var_dump($dao);
    $aUser = $dao->findUserInfoByUserName($username);
    //var_dump($aUser);
    if (isset($aUser)) {
        if ($password == $aUser->getPW()) {
            //echo $aUser->getPeople()->getXm();

            session_start();
            $_SESSION['currentUser']=$aUser;
            return true;
        }
    } else {
        return false;
    }
}

if (isset($_POST['submit'])) {
    $username=$_POST['username'];
    $password=$_POST['password'];

    echo  $username;
    echo $password;
    if (userLogin($username, $password)) {
       // echo '用户验证通过！';
        header('location:'.'/student/index.php');
    } else {
        // echo 'not ok';
        echo '用户验证失败！';
    }
}
?>

<div>
    <fieldset>
        <legend>用户登录</legend>
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" id="form1">
            <input type="text" name="username" id="txtusername">
            <input type="password" name="password" id="txtpassword"/>
            <input type="submit" name="submit"/>
        </form>
    </fieldset>
</div>

<script src="/javascripts/jquery-1.10.2.min.js"></script>
<script type="text/javascript">

    //检查用户输入
    function checkUserInput(){
       var username= $("#txtusername").val();
       if (username=="")
       {
           alert('请输入用户名！');
           return false;
       }
        var password= $("#txtpassword").val();

        if (password=="")
        {
            alert('请输入登录密码！');
            return false;
        }

        return true;
    }

    $().ready(function () {

        $("input[type='submit'][name='submit']").bind('click',function () {
           // alert('click');
            return checkUserInput();
        })
    });
</script>
</body>
</html>
