<?php
$pdo = new PDO('mysql:host=localhost;dbname=new;port=3306','root','password');
$pdo->exec('set names utf8');

$stmt = $pdo->prepare("select * from usr where id =:id");
$stmt->bindValue(':id',1,PDO::PARAM_INT);
$stmt->execute();
$rows = $stmt->fetchAll();
print_r($rows);
echo "<br />";
// $rows = $pdo->query("select * from usr where id = 1")->fetchAll(PDO::FETCH_ASSOC);

for($i=0;!empty($rows[$i]);$i++){
	echo "ID:".$rows[$i]['id']."<br />";
	echo "Username:".$rows[$i]['username']."<br />";
	echo "Password:".$rows[$i]['password']."<br />";
}
$pdo = NULL;

?>