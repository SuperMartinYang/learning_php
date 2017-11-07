<?php
$dbh = new PDO("mysql:host=localhost;dbname=new","root","password");
$dbh ->exec("SET CHARACTER SET utf8");
$result = $dbh ->query("DELETE FROM usr WHERE id ='3'");
if($result->rowCount()>0){
	echo "数据已经删除";
}else{
	echo "数据删除失败";
}
$dbh=null;
?>