<?php
//====第一步：引用Mail和Mail_Mime
include ('Mail.php');
include ('Mail/mime.php');
//====第二步：进行内容设置
$param['text_charset'] = 'utf-8';
$param['html_charset'] = 'utf-8';
$param['head_charset'] = 'utf-8';
$mime = new Mail_mime('\n');
$mime->setTXTBody('这是正文！');
//可以增加任意多的附件，注意邮件的mime类型设置
// $mime->addAttachment('http://f.hiphotos.baidu.com/zhidao/pic/item/1e30e924b899a901f13830bc1f950a7b0208f52f.gif','image/gif','1e30e924b899a901f13830bc1f950a7b0208f52f');
$mime->addAttachment('C:\Users\yangshenghui\Desktop\AscII表.jpg','image/jpg','AscII表');
//构建邮件主体
$body = $mime->get($param);
//构建邮件报头
$hdrs = array(
		'From' =>'810821004@qq.com',
		'To' =>'martinyang1994@gmail.com',
		'Subject' =>'这是邮箱的标题',
		'Content-type' =>'text/plain;charset=utf-8'
);
$headers = $mime->headers($hdrs);
//====第三步：远程SMTP服务的配置
$params['host'] = 'smtp.qq.com';
$params['port'] = 25;
$params['auth'] = true;
$params['username'] = '810821004';
$params['password'] = 'wbtxwkfhoajhbcba';
//====第四步：执行发送
//首先创建一个mail实例，传给正确的配置信息
//注意这里没有使用构造方法，而是使用Mail::factory方法
$mail_object = & Mail::factory('smtp',$params);
//然后发送
$recipients = 'martinyang1994@gmail.com';
$send = $mail_object->send($recipients,$headers,$body);
//发送成功后释放对象
$mail_object = NULL;
if(PEAR::isError($send)){
	echo $send->getMassage();
}else{
	echo '成功发送！';
}
?>