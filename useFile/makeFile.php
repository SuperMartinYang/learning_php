//打开文件
<?php
$filepath = "";
if(!file_exists($filepath)){
	fopen($filepath, "w");
}else{
	fopen($filepath, "r");
	//fopen($filepath,"x");
}
?>


//操作文件
<?php 
$filepath = "";
if(file_exists($filepath)){
	//改变当前工作目录，然后使用rename()函数可以一栋文件到当前工作目录
	chdir("");	//改变工作目录
	rename($filepath, basename($filepath));
	rename(basename($filepath), "file.txt");
	//rename($filepath,"file.txt");		//改名
	//copy("file.txt","newfile.txt");	//复制
	//unlink("file.txt")		//删除
}
?>

//文件中添加数据
<?php 
$filepath = "";
//以w模式打开，这是一个可写模式
//但是这种模式先把文件截为0字节大小，然后写入，这意味着重新定义文件内容
$file_pointer = fopen($filepath, "w");
fwrite($file_pointer, "this is a test.");
fclose($file_pointer);
//如果没有出错，意味着写入成功
echo "数据成功写入文件";
?>

//追加数据
<?php 
$filepath = "";
//以a模式打开，这是一个科协模式
//这种模式将内容追加到文件内容后面
$file_pointer = fopen($filepath, "a");
fwrite($file_pointer, "this is a test.");
fclose($file_pointer);
//如果没有出错，意味着写入成功
echo "数据成功写入文件";
?>

//独占文件，防止多个程序读取同个文件
<?php 
$filepath = "";
//以a模式打开，这是一个科协模式
//这种模式将内容追加到文件内容后面
$file_pointer = fopen($filepath, "a");
if(flock($file_pointer, LOCK_EX)){		//排他性锁定
	fwrite($file_pointer, "this is a test.");
	flock($file_pointer, LOCK_UN);		//释放锁定
}
fclose($file_pointer);
//如果没有出错，意味着写入成功
echo "数据成功写入文件";
?>

//直接写入文本的方式
<?php 
file_put_contents("C:\\text.txt", "this is a file.",FILE_APPEND|LOCK_EX);	//文本内容换行，采用\n或者\r\n或者\r
//没有出错
echo "数据成功写入";
?>

//直接读取文件file_get_contents或者file
<?php 
//file_get_contents
//使用相对路径
$localfile = file_get_contents("PDO/test.php");
//使用绝对路径
$localfile = file_get_contents("G:\\PDO\\test.php");
//使用file：//协议
$localfile = file_get_contents("file:///G:/PDO/test.php");
//使用http协议读取远程文件
$httpfile = file_get_contents("http://www.baidu.com/test.php");
//使用https协议读取远程文件
$httpsfile = file_get_contents("https://www.baidu.com/test.php");
//使用ftp协议读取远程文件
$ftpfile = file_get_contents("ftp://user:pass@ftp.zhang.com/test.php");


//file
//将文件以行为键，内容为 value赋值给数组
$line = file("https://www.baidu.com/test.php");
foreach($line as $key =>$value){
	echo "Line#<b>{$key}</b>:".htmlspecialchars($value)."<br />";
}
?>

//读取本地文件并显示在网页上
<?php 
$filepath = "C:\\test.gif";
$handle = fopen($filepath, "rb");
$length = filesize($filepath);
$contents = fread($handle, $length);
header("Content-type:image/GIF",true);
echo contents;
fclose($handle);
?>

//读取远程文件并显示
<?php 
$filepath = "http://www.baidu.com/test.gif";
$handle = fopen($filepath, "rb");
$contents = "";
while (!feof($handle)){
	$content .= fread($handle,8192); 
}
//也可以使用流方式(这样就不用使用循环)		$contents = stream_get_contents($handle);
header("Content-type:image/GIF",true);
echo $contents;
fclose($handle);
?>

//文件下载,避免暴露绝对路径使用readfile函数
<?php 
$filepath = "text.txt";
$real_path = realpath($filepath);
download($real_path);
function download($f_name){
	header("Cache-Control:must-revalidate,post-check=0,pre-check=0");
	header("Content-Description:File Transfer");
	header("Content-Type:application/octet-stream");
	header("Content-Length:".@filesize($f_name));
	header("Content-Disposition:attachment;filename=".@basename($f_name));
	@readfile($f_name) or die("文件没有被发现");
}
?>