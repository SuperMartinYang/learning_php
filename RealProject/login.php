<?php
session_start();
//注销登录
if($_GET['action'] == "logout"){
	unset($_SESSION['userid']);
	unset($_SESSION['username']);
	echo '注销登录成功！点击此处 <a href="login.html">登录</a>';
	exit;
}
//登录
if(!isset($_POST['submit'])){
	echo '非法访问';
}
//获取请求的值
$username=htmlspecialchars($_POST['username']);
$password=md5($_POST['password']);
//与数据库中的数据比较，认证
include 'conn.php';
$result = $conn->query("SELECT uid FROM user WHERE username='$username' AND password='$password' LIMIT 1");
$resultRow = $result->fetch();
if(!empty($resultRow)){
	//登录成功
	$_SESSION['username'] = $username;
	$_SESSION['userid'] = $resultRow['uid'];
	echo $username,' 欢迎你！进入 <a href="my.php">用户中心</a><br />';
	echo '点击此处 <a href="login.php?action=logout">注销</a> 登录！<br />';
	exit;
} else {
	exit('登录失败！点击此处 <a href="javascript:history.back(-1);">返回</a> 重试');
}
$conn = NULL;
?>