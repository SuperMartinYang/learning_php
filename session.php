<?php
session_start();
if (!isset($_SESSION["visitorCount"])){
	$_SESSION["visitorCount"]=1;
}else {
	$_SESSION["visitorCount"]++;
}
?>
<b>欢迎你第<font color="FF0000">
<?php echo $_SESSION["visitorCount"];?>
</font>
访问COOKIE
</b>
