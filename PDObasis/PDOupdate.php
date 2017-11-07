<?php
$dbh = new PDO("mysql:host=localhost;dbname=new","root","password");
$dbh ->exec("SET CHARACTER SET utf8");
$result = $dbh->query("UPDATE usr SET id = '3',username = '33',password = '333' WHERE id = '2'");
if($result->rowCount()>0){
	echo "数据已经更新";	
}else{
	echo "数据更新失败";
}
$dbh=null;
?>