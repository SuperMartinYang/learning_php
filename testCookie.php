<?php
$CookieEnabled=NULL;
if (isset($_GET["CookieEnabled"])){
	$CookieEnabled=$_GET["CookieEnabled"];
}else{
	setcookie("testCookie","ok",60+time());
	header("Location:isSetCookie.php",true,302);
	exit;
}
if(isset($_COOKIE["testCookie"])){
	if ($_COOKIE["testCookie"]=="ok"&&$CookieEnabled=="true"){
		echo(iconv("GB2312", "UTF-8", "支持COOKIE"));
	}else if($_COOKIE["testCookie"]==NULL&&$CookieEnabled=="false"){
		echo(iconv("GB2312", "UTF-8", "不支持COOKIE"));
	}
}else{
	echo(iconv("GB2313", "UTF-8", "不支持COOKIE"));
}
?>