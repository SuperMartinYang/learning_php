<?php
$visitorCount = 1;
if (isset($_COOKIE["visitorCount"])){
	$_COOKIE["visitorCount"]?($visitorCount = (int)$_COOKIE["visitorCount"]+1):($visitorCount=1);
	setcookie("visitorCount",$visitorCount,time()+31536000);
}else {
	setcookie("visitorCount",1,time()+31536000);
}
echo "<b>欢迎你第<font color=\"FF0000\">".$visitorCount."</ font>访问COOKIE</b><br />";
?>