<?php
try{
$dbh =new PDO("mysql:host=localhost;dbname=new","root","password");
$dbh->exec("SET CHARACTER SET utf8");
$result = $dbh->query("SELECT * FROM photo WHERE id ='1'");
$row =$result->fetch();
if (!empty($row)){
	header("Content-type:image/JPEG",true);
	echo $row["photo"];
}else {
	echo "读取失败";
}
$dbh=null;
}catch(Exception $e){
	echo $e->getMessage();
}
?>