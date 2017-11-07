<?php
use Org\Util\ArrayList;
//====连接数据库的文件，以防止泄露密码
$conn = new PDO("mysql:host=localhost;dbname=android","root","password");
if(!$conn){
	die("数据库连接失败".$conn->errorCode());
}
//设置字符编码
$conn->exec("SET CHARACTER SET utf8");
//执行查询并将结果保存在一个变量中,result是PHPStatement对象
$result = $conn->query("SELECT * FROM Virus");

//获取第一行数据
$json_array = array();
//写入数据记录，首先查看是否存在记录
while (!empty($row = $result->fetch())){
	$json = array(
			'id'=>$row['id'],
			'manifest'=>$row['manifest'],
			'java'=>$row['java'],
			'file'=>$row['file']
			);
	array_push($json_array, $json);
}
echo json_encode($json_array);
//显示关闭PDO连接
$conn = NULL;
?>