<?php
//创建一个PDO对象
$dbh= new PDO("mysql:host=localhost;dbname=new", "root", "password"); 
// 设置字符编码
$dbh ->exec("SET CHARACTER SET utf8");

//执行查询并将结果保存在一个变量中,result是PHPStatement对象
$result = $dbh->query("SELECT * FROM usr");	

//获取第一行数据
$row = $result->fetch();	

//写入数据记录，首先查看是否存在记录
if(!empty($row)){
	echo "ID:".$row["id"]."<br />";
	echo "username:".$row["username"]."<br />";
	echo "password:".$row["password"]."<br />";
}

//显示关闭PDO连接
$dbh = NULL;

?>