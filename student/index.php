<html>
<head>
    <meta charset="gbk"/>


</head>
<title>学生主页</title>
<body>
<h2>学生主页</h2>
<?php
require_once('../base.php');
require_once (ROOT.'/model/UserInfo.php');
require_once (ROOT.'/model/StudentInfo.php');

  session_start();
  if (isset($_SESSION['currentUser'])){
      $aUser = $_SESSION['currentUser'];
     //var_dump($aUser);
     echo '你好，'. $aUser->getPeople()->getXM().' 同学';
  }
  //echo '你好'. $_SESSION['currentUser']->getPeople()->getXm();
?>


</body>
</html>

