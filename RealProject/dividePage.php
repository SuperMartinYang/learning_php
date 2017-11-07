<?php
//建立数据库连接
$mysql = new PDO("mysql:host=localhost;dbname=new","root","xmm520..");
$mysql->exec("SET CHARACTER SET utf8");
//每页显示的记录数
$pageSize = 2;
//用户请求的网页
$page =$_GET["page"]?$_GET["page"]:1;
//偏移数据库指针
$pagePointer = ($page-1)*$pageSize;
//查询本页应该显示的数据
$result = $mysql->query("SELECT * FROM guestbook ORDER BY id DESC LIMIT $pagePointer,$pageSize");
//循环输出查询到的数据
while($row = $result->fetch()){
    echo '<a href="',$row['nickname'],'">',$row['nickname'],'</a> ';
    echo '发表于：',date("Y-m-d H:i", $row['createtime']),'<br />';
    echo '内容：',$row['content'],'<br /><hr />';
}
//设置分页
//计算分页数
$totalRecord = $mysql->query("SELECT count(*) as count FROM guestbook");
$total = $totalRecord->fetch();
$pageNum=ceil($total['count']/$pageSize+1);
echo '共 ',$total['count'],' 条留言';

if ($pageNum>1) {
	for($i = 1;$i<$pageNum;$i++){
		if ($i == $page) {
			echo "[$i]";
		}else{
			echo "<a href='dividePage.php?page=$i'>$i</a>";
		}
	}
}
$mysql = NULL;

?>