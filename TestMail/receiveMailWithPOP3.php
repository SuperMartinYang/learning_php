<?php
//====第一步：引用Net_POP3
include('Net\POP3.php');
//====第二步：建立到邮箱的连接
//创建新的Net_POP3实例
$pop3 = new Net_POP3();
//创建几个变量，用来定义连接信息
$user = '810821004';
$pass = 'wbtxwkfhoajhbcba';
$host = 'pop.qq.com';
$port = "25";
//连接到邮件服务器
if(PEAR::isError($ret=$pop3->connect($host,$port))){
	echo "出错".$ret->getMessage()."<br />";
	exit();
}
//登录到邮箱
if(PEAR::isError($ret=$pop3->login($user,$pass,'USER'))){
	echo "出错".$ret->getMessage()."<br />";
	exit();
}
//====第三步：获取邮件
$list = $pop3->getListing();
if(!$list){
	echo '邮箱中没有邮件';
}
//遍历每一封邮件
echo '请下载邮件：<br />';
foreach($list as $mail){
	//打开一个文件，用来将邮件存储在本地服务器上
	//注意邮件的命名，一个UUID+时间戳，肯定不会有重复的文件名
	//注意必须存在attachments目录
	$file = 'attachments/'.uniqid().'_'.time().'.eml';
	if($Buffer = fopen($file,"w+")){
		fwrite($Buffer, $pop3->getMsg($mail['msg_id']));
		fclose($Buffer);
		echo "<a href=\"$file\">第".(++$i)."封邮件!</a><br />";
	}else{
		echo "不能保存邮件！<br />";
	}
}
//====第四步：断开连接
$pop3->disconnect();
exit();

?>