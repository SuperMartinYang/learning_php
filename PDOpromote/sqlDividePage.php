<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>sqlDividePage</title>
</head>
<body>
<?php
//PDO分页导航函数
function writeNavigation($p_rs,$p_pageSize,$p_pageIndex,$p_totleRS,$p_strURL){
	//获得分页书
	$pageCount = (int)ceil($p_totleRS/$p_pageSize);
	//通过计算获得分页开头记录和结束记录号
	$recordHead = 1;
	if($p_pageIndex>1){
		$recordHead = $p_pageSize*($p_pageIndex-1)+1;
	}
	if ($p_pageIndex>=$pageCount) {
		$recordLast=$p_totleRS;
	}else{
		$recordLast = $p_pageSize*$p_pageIndex;
	}
	//定义一个字符串用于函数返回值
	$result="";
	$result = $result."<table width=\"600\"><tr><td colspan=\"3\">";
	$result = $result."第".$recordHead."-".$recordLast."条，共".$p_totleRS."条，每页显示".$p_pageSize."条";
	
	//定义翻页变量
	$prevPage = $p_pageIndex-1;
	$nextPage = $p_pageIndex+1;
	
	//判断输入的URL已经包含的查询变量
	if(strpos($p_strURL,"?")==FALSE){
		$p_strURL = $p_strURL."?";
	}else{
		$p_strURL = $p_strURL."&";
	}
	
	//定义导航条
	$firstPage = "<a href=\"".$p_strURL."page=1\">[首页]</a>";
	$lastPage ="<a href = \"".$p_strURL."page=".$pageCount."\">[尾页]</a>"; 
	if($p_pageIndex>1){
		$prevPage = "<a href =\"".$p_strURL."page=".$prevPage."\">[上页]</a>&nbsp;";

	}
	if($p_pageIndex<$pageCount){
		$nextPage = "<a href = \"".$p_strURL."page=".$nextPage."\">[下页]</a>&nbsp;";
	}
	if($p_pageIndex==$pageCount){
		$nextPage = "[下页]&nbsp;";
		$lastPage = "[尾页]";
	}
	if($p_pageIndex<=1){
		$prevPage = "[上页]&nbsp;";
		$firstPage = "[首页]&nbsp;";
	}
	$result = $result."<tr align = \"right\"><form name =\"form\" method =\"post\" action=\"".$p_strURL."\"><td align=\"left\">";
	$result = $result."共".$pageCount."页&nbsp;"."目前是第".$p_pageIndex."页</td><td>";
	$result = $result."&nbsp;到第<input type=\"text\" name =\"page\" size = \"3\" style=\"height:16px;margin-bottom:2px;\" />页<input type = \"submit\" value = \"GO\" style =\"height:25px;margin-bottom:1px\" />";
	$result = $result."</td><td>".$firstPage.$prevPage.$nextPage.$lastPage."</td></form></tr></table>";
	
	return $result;
}
//PDO分页数据函数
function writePageRS($p_rs,$p_pageSize,$p_pageIndex){
	$result = "";
	$result =$result."<table><tr bgcolor=\"#637E94\">";
	//写结果集字段名，因为一些数据库驱动不支持元数据
	//所以不能使用getColumnMeta()方法，而只能从返回中获取字段名
	$row = $p_rs->fetch(PDO::FETCH_ASSOC);
	if(empty($row)){
		throw new Exception("出错，请重试。");
		die();
	}
	$key = array_keys($row);
	$columnSize = count($key);
	for($j= 0;$j<$columnSize;$j++){
		$result = $result."<th width = \"150\">".$key[$j]."</th>";
	}
	$result = $result."</tr>";
	//写结果集数据
	$id = 0;
	while($id<$p_pageSize){
		if(empty($row)){
			break;
		}
		$id++;
		//隔行设置不同背景色
		if($id%2==0){
			$result = $result."<tr bgcolor = \"#E3EAEF\">";
		}else{
			$result = $result."<tr bgcolor = \"#FFFFFF\">";
		}
		//写入数据
		for($j = 0;$j<$columnSize;$j++){
			$result = $result."<td>".$row[$key[$j]]."</td>";
		}
		$result = $result."</tr>";
		//获取下一跳记录
		$row = $p_rs->fetch(PDO::FETCH_ASSOC);
	}
	$result = $result."</table>";
	return $result;
}
?>

<?php 
$rs_start = 0;
$rs_end = 0;
//$pageSize表示每页的记录数
//$strURL表示处理分页结果集的文件路径
$pageSize = 3;
$totalRS = 0;
$strURL = "sqlDividePage.php";

try {
	$dbh= new PDO("mysql:host=localhost;dbname=new", "root", "xmm520..");
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$result = $dbh->query("SELECT count(*) FROM usr");
	if(!empty($result)){
		$totalRS = $result->fetch()[0];
	}else{
		echo "没有记录。";
	}
	$dbh = NULL;
} catch (PDOException $e) {
	try {
		$dbh = NULL;
	} catch (PDOException $e) {
		echo "出错，请重试。";
	}
	echo "1".$e->getMessage();
	die();
}

try {
	//创建一个PDO对象，用于使用LIMIT 子句	
	$dbh= new PDO("mysql:host=localhost;dbname=new", "root", "xmm520..");
	$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	$dbh->exec("SET CHARACTER SET utf8");
	//准备预处理语句
	$sth = $dbh->prepare("SELECT id,username,password FROM usr LIMIT ?,?");
	$sth->bindParam(1,$rs_start,PDO::PARAM_INT,10);
	$sth->bindParam(2,$rs_end,PDO::PARAM_INT,10);
} catch (PDOException $e) {
	echo "出错，请重试。";
	try {
		//显示关闭数据库
		$dbh = NULL;
	} catch (PDOException $e) {
		echo "出错，请重试。";
	}
	echo "2".$e->getMessage();
	die();
}

$flag = FALSE;
try {
	//获得当前结果集分页页码
	$pageIndex = 1;
	try {
		if(isset($_REQUEST["page"])){
			$pageIndex = (int)$_REQUEST["page"];
		}
	} catch (Exception $e) {
		$pageIndex = 1;
	}
	$rs_start = ($pageIndex-1)*$pageSize;
	$rs_end = $pageSize;
	
	//执行预处理语句，并将结果保存在$sth中
	$flag = $sth->execute();
	if(!$flag){
		echo "没有记录。";
	}else{
		$pageCount = (int)ceil($totalRS/$pageSize);	//分页数
		if($pageIndex==1||$pageIndex<1){
			$pageIndex = 1;
		}else if($pageIndex>$pageCount){
			$pageIndex = $pageCount;
		}
		
		//分页写数据
		echo writePageRS($sth, $pageSize, $pageIndex);
		//写分页导航信息
		echo writeNavigation($sth, $pageSize, $pageIndex, $totalRS, $strURL);
	}
} catch (Exception $e) {
	echo "3".$e->getMessage();
	echo "出错，请重试";
}
?>
<?php 
try {
	$dbh = NULL;
} catch (PDOException $e) {
	echo "4".$e->getMessage();
	echo "出错，请重试。";
}
?>
</body>
</html>