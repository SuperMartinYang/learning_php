<?php
class employee{
	public function __construct($param1,$param2){
		echo $param1;
		echo $param2;
	}
}
$dbh= new PDO("mysql:host=localhost;dbname=new", "root", "password"); 
$str = $dbh->prepare("SELECT username,password FROM usr WHERE id =?");
$ID = 1;
//设置参数的两种方法bindParam和bindValue
// $str->bindParam(1,$ID,PDO::PARAM_INT,10);
$str->bindValue(1, 2,PDO::PARAM_INT);
$str->execute();
$str->setFetchMode(PDO::FETCH_CLASS,"employee");
$a = $str->fetch();

if(!empty($str)){
// 	echo "username:".$a['username'];
// 	echo "password:".$a['password'];
	print_r($a);
}
?>