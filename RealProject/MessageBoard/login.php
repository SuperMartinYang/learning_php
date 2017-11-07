<?php
include 'conn.php';
include 'config.php';
//获取请求网页
$page = $_GET['page']?$_GET['page']:1;
//数据指针
$offset = ($page-1)*$pageSize;
//请求数据库记录
$result = $conn->query("SELECT * FROM messageBoard ORDER BY id LIMIT $offset,$pageSize");
//出错处理
if(!$result){
	exit("出错：连接数据失败。".$conn->errorCode());
}
//显示结果

while ($record = $result->fetch()) {
	echo $record['nickname'],' ';
    echo '发表于：',date("Y-m-d H:i", $record['createtime']),'<br />';
    echo '内容：',nl2br($record['content']),'<br /><hr />';
    // 回复
    if(!empty($record['replytime'])) {
        echo '----------------------------<br />';
        echo '管理员回复于：',date("Y-m-d H:i", $record['replytime']),'<br />';
        echo nl2br($record['reply']),'<br /><br />';
    }
    echo '<hr />';
}
//分页格式
$query = $conn->query("SELECT count(*) AS count FROM messageBoard");
$recordNum = $query->fetch();
$pageNum = ceil($recordNum/$pageSize);
//显示留言总数
echo "总共".$recordNum."条记录";
if($pageNum>1){
	for ($i = 1;$i<$pageNum;$i++){
		if($i == $_GET['page']){
			echo '['.$i.']';
		}else {
			echo "<a href='login.php?page=$i'>[$i]</a>";
		}	
	}
}
//关闭数据库连接
$conn = NULL;
