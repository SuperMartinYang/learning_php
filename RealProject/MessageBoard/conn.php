<?php
//====连接数据库的文件，以防止泄露密码
$conn = new PDO("mysql:host=localhost;dbname=new","root","xmm520..");
if(!$conn){
	die("数据库连接失败".$conn->errorCode());
}
//设置字符编码
$conn->exec("SET CHARACTER SET utf8");
?>