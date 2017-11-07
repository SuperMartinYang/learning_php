<?php 
	$iscc = array(
			"bar1" => "0x1000",
			"bar2" => array(
					0 => 1,
					"nudt" => 2,
					1 => 1,
					2 => 1,
					3 => 1
			)
	);
	echo json_encode($iscc);	
	$c[0] = array();
	$c[1] = array();
	$b = 2017;
	echo !strcmp($c[1],$b)? yes:no;
	echo "\n";
	echo $c[0].$b;
// 	eregi("3|1|c",$)?print_r("nope"):NULL;
	strpos(($c[0].$d), "isccctf2017")?$v3=1:NULL;
	echo $v3;
	if ($iscc["bar1"]>2017){
		echo "big";
	}
?>