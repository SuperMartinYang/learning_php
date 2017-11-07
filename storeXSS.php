<?php
try{
$dbh= new PDO("mysql:host=localhost;dbname=new", "root", "password"); 
$dbh ->exec("SET CHARACTER SET utf8");
	
$stmt = $dbh->prepare("INSERT INTO XSS (id,xss) VALUES (?,?)");
$stmt->bindValue(1, "1");
$stmt->bindValue(2, "a");
$result =$stmt->execute();
echo $result->rowCount();
if($result->rowCount()>0){
	echo "succeed";
}else{
	echo "failed";
}
$dbh = NULL;
}catch(PDOException $e){
	echo $e->getMessage();
}finally {
	$dbh = NULL;
}
?>