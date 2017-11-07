<?php
if(!isset($_POST['submit'])){
	exit ("非法访问");
}
//接收post消息
$username = $_POST['username'];
$password = $_POST['password'];
$email = $_POST['email'];
//使用正则表达式验证输入是否合法

//验证姓名
if(!preg_match('/^[\w\x80-\xff]{3,15}$/', $username)){
	exit('错误：输入的用户名不合法。<a href="javascript:history.back(-1);">返回</a>');
}
if(strlen($password)>6){
	exit('错误：输入的密码过长。<a href="javascript:history.back(-1);">返回</a>');
}
if(!preg_match('/^([0-9A-Za-z\\-_\\.]+)@([0-9a-z]+\\.[a-z]{2,3}(\\.[a-z]{2})?)$/i', $email)){
	exit('错误：输入的email不合法。<a href="javascript:history.back(-1);">返回</a>');
}
//使用数据库连接，并添加数据
include 'conn.php';
//判断是否已经有这个用户

$exist=$conn->query("SELECT uid FROM user where username='$username' LIMIT 1");
$row = $exist->fetch();
if (!empty($row)) {
	echo '错误：用户名 ',$username,' 已存在。<a href="javascript:history.back(-1);">返回</a>';;
	exit;
}

//插入数据
$password = md5($password);
$regdate = time();
$result = $conn->query("INSERT INTO user (username,password,email,regdate) VALUES ('$username','$password','$email',$regdate)");
if($result->rowCount()>0){
	exit('用户注册成功！点击此处 <a href="login.html">登录</a>');
}else{
	echo '抱歉！添加数据失败：'.mysql_error().'<br />';
    echo '点击此处 <a href="javascript:history.back(-1);">返回</a> 重试';
}

$conn = NULL;

?>