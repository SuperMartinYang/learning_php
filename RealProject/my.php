<?php
session_start();
//检测是否登录，如果没有登录则不能访问
if(!isset($_SESSION['userid'])){
	header("Location:login.html");
	exit();
}

//登录成功返回个人信息
include 'conn.php';
$username = $_SESSION['username'];
$uid = $_SESSION['userid'];

$result = $conn->query("SELECT * FROM user WHERE uid=$uid LIMIT 1");
$row = $result->fetch();
//打印结果
echo '用户信息：<br />';
echo '用户ID：',$uid,'<br />';
echo '用户名：',$username,'<br />';
echo '邮箱：',$row['email'],'<br />';
echo '注册日期：',date("Y-m-d", $row['regdate']),'<br />';
echo '<a href="login.php?action=logout">注销</a> 登录<br />';

?>