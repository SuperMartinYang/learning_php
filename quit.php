<?php
$str = "a1zLbgQsCESEIqRLwuQAyMwLyq2L5VwBxqGA3RQAyumZ0tmMvSGM2ZwB4tws";
function encode($str){
	$_o = strrev($str);//反转字符串
	for ($_0=0;$_0<strlen($_o);$_0++){//从字符串第一个字符开始
		$_c = substr($_o,$_0,1);//取出第_0位的那一个字符
		$__=ord($_c)+1;//返回_c的asc码值
		$_c = chr($__);//转换为字符
		$_=$_.$_c;//结合到一起
	}
	return str_rot13(strrev(base64_encode($_)));
}
function decode($str){
	$a=base64_decode(strrev(str_rot13($str)));
	for($b = 0;$b<strlen($a);$b++){
		$c = substr($a,$b,1);
		$d = ord($c)-1;
		$c = chr($d);
		$_ = $_.$c;
	}
	return $_;
}
echo strrev(decode($str))
?>