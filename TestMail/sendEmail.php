<?php
//=====第一步：引用Mail
include 'Mail.php';
//=====第二步：进行内容设置
$header['From'] = '810821004@qq.com';
$header['To'] = 'martinyang1994@gmail.com';
$header['Subject'] = '这是邮件标题';
$body = '这是正文。';
//=====第三步：远程SMTP服务的配置
$param['host'] = 'smtp.qq.com';
$param['port'] = 25;
$param['auth'] = true;
$param['username'] = '810821004';
$param['password'] = 'wbtxwkfhoajhbcba';
//=====第四步:执行发送
//首先创建一个Mail实例，传给正确的配置信息
//注意这里没有使用构造方法，而是使用Mail::factory方法
$mail_object = & Mail::factory('smtp',$param);
//然后发送
$recipients = 'martinyang1994@gmail.com';
$send = $mail_object->send($recipients,$header,$body);
$mail_object =NULL;
if (PEAR::isError($send)){
	echo $send->getMessage();
}else{
	echo '成功发送！';
}
?>