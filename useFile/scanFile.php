<?php
/**
 * 本函数写出目录树中的所有文件和目录
 * 使用scandir函数
 * @param string $dirpath 定义目录的绝对路径
 * @return Array 返回一个数组，包含所有的文件和目录
 */
 function list_dir($dirpath){
 	//判断路径最后面的字符是否是反斜线，如果没有就加上一个
 	if($dirpath[strlen($dirpath)-1]!='\\'){
 		$dirpath.='\\';
 	}
 	static $result_array = array();
 	//判断给出的路径是否为目录
 	if(is_dir($dirpath)){
 		//获取当前的子目录和文件
 		$file_dir = scandir($dirpath);
 		//遍历所有的文件夹名和文件名
 		foreach ($file_dir as $file){
 			//如果是两个特殊目录，就跳过去
 			if($file =='.'||$file=='..'){continue;}
 			if(is_dir($dirpath.$file)){
 				//如果是目录则递归调用
 				list_dir($dirpath.$file);
 			}else{
 				//如果是文件，存入数组
 				array_push($result_array, $dirpath.$file);
 			}
 		}
 	}
 	return $result_array;
 }
 //测试程序，列出G:\学习笔记目录下的所有文件
 $array = list_dir("G:\\JAVAworkspace");
 foreach($array as $value){
 	echo $value."<br />";
//  	showinfo($value);
 }
?>