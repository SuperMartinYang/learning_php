<?php
$v1=0;$v2=0;$v3=0;
$a=(array)json_decode(@$_GET['iscc']);
$flag = 'aaa';
if(is_array($a)){
	echo @$a["bar1"];
	is_numeric(@$a["bar1"])?die("nope1"):print_r("pass");
	if(@$a["bar1"]){
		($a["bar1"]>2016)?$v1=1:print_r("fun");
		echo $v1;
	}
	if(is_array(@$a["bar2"])){
		echo "array";
		if(count($a["bar2"])!==5 OR !is_array($a["bar2"][0])) die("nope");
		$pos = array_search("nudt", $a["bar2"]);
		$pos===false?die("nope2"):NULL;
		foreach($a["bar2"] as $key=>$val){
			$val==="nudt"?die("nope3"):NULL;
		}
		$v2=1;

	}
}
$c=@$_GET['cat'];
$d=@$_GET['dog'];
if(@$c[1]){
	if(!strcmp($c[1],$d) && $c[1]!==$d){

		eregi("3|1|c",$d.$c[0])?die("nope4"):NULL;
		strpos(($c[0].$d), "isccctf2017")?$v3=1:NULL;

	}

}
if($v1 && $v2 && $v3){
	 
	echo $flag;
}
?>