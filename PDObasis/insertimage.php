<?php

try{
echo $_FILES["myfile"]["tmp_name"];
$fp = fopen($_FILES["myfile"]["tmp_name"], "rb");
$buf = addslashes(fread($fp,$_FILES["myfile"]["size"]));
$dbh = new PDO("mysql:host=localhost;dbname=new","root","password");
$result = $dbh->query("INSERT INTO photo (id,photoName,photo) VALUES ('1','oh','$buf')");
if ($result->rowCount()>0){
	echo "图片已经插入";
}else{
	echo "图片插入失败";
}
$dbh =NULL;
}catch (PDOException $e){
	echo $e->getMessage();
}
?>