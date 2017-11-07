<?php
// $username = $_REQUEST['username'];
$phoneNo = $_REQUEST['phoneNo'];
$password = $_REQUEST['password'];


$dbh = new PDO("mysql:host=localhost;dbname=testdb","tauat","password");
$dbh->exec("SET CHARACTER SET utf8");

$exist=$dbh->query("SELECT iduser FROM user where phoneNo='$phoneNo' LIMIT 1");
$row = $exist->fetch();
if (!empty($row)) {
	echo '错误：用户名 '.$phoneNo.' 已存在。';;
	exit;
}
//获取当前存在的用户数
$count = $dbh->query("SELECT COUNT(*) FROM user");
$count = $count->fetchAll();
$num = $count[0][0]+1;
//插入数据
$password = md5($password);
$result = $dbh->query("INSERT INTO user (iduser,phoneNo,password) VALUES ($num,'$phoneNo','$password')");
var_dump($result);
if($result->rowCount()>0){
	exit('用户注册成功！');
}else{
	echo '抱歉！注册失败';
}

$dbh = NULL;

?>