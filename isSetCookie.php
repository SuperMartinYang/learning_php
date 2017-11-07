<?php
if (isset($_COOKIE["testCookie"])){
	$testCookie=$_COOKIE["testCookie"];
	if($testCookie=="ok"){
		header("Location:testCookie.php?CookieEnabled=true",true,302);
		exit;
	}else{
		header("Location:testCookie.php?CookieEnabled=false",true,302);
		exit;
	}
}else {
	header("Location:testCookie.php?CookieEnabled=false",true,302);
	exit;
}
?>