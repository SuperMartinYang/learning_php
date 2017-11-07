<?php
class employee{
	public function __construct($param1,$param2){
		echo $param1."<br />";
		echo $param2."<br />";
	}
}

?>
<pre>
<?php 
	try {
		$dbh =new PDO("mysql:host=localhost,dbname=new","root","password");
		$dbh = setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
		$dbh = exec("SET CHARACTER SET utf8");
		$sth = $dbh->prepare("SELECT username,password FROM usr");
		$sth->execute();
		$obj = $sth->fetchObject("employee",array("参数1","参数2"));
		var_dump($obj);
		$obj = $sth->fetchObject("employee",array("参数1","参数2"));
		var_dump($obj);
		$dbh = NULL;
	} catch (PDOException $e) {
		echo $e->getMessage();
		die();
	}

?>
</pre>