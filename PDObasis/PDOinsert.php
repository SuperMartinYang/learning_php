<?php
$dbh = new PDO("mysql:host=localhost;dbname=new","root","password");
var_dump($dbh);
$dbh->exec("SET CHARACTER SET utf8");

$result = $dbh->query("INSERT INTO usr (id,username,password) VALUES ('2','22','222')");

if ($result->rowCount()>0){
	echo "数据已经插入";
}else {
	echo "数据插入失败";
}
$count = $dbh->query('select count(*) from usr');
$count = $count->fetchAll();
echo $count[0][0];
$dbh=null;
?>