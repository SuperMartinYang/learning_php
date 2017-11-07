<?php
session_start();    
echo $_REQUEST['autocode'];
echo $_SESSION['authcode'];
if(isset($_REQUEST['autocode'])){
  	if(strtolower($_POST['autocode']) !== $_SESSION['authcode']){
      die('错误！');
  	}
}
echo phpinfo();
?>