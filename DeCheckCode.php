<?php 
$image_name = '1.jpg';
$image = "http://106.75.30.59:8888/code.php";    
 
 
$curl = curl_init(); 
curl_setopt($curl, CURLOPT_URL, $image); 
curl_setopt($curl, CURLOPT_COOKIE, 'PHPSESSID=s7k8er1ifhl3p30880sqqumvi7'); 
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); 
$result = curl_exec($curl); 
curl_close($curl); 
file_put_contents($image_name, $result);
 
 
$size = getimagesize($image_name);
$im = imagecreatefromjpeg($image_name);
imagejpeg($im, '1.jpg',100);
$width = $size[0];
$height = $size[1];
 
 
for($x = 1; $x < $width; $x ++)
{
    for($y = 1; $y < $height; $y ++)
    {
        $color = imagecolorat($im, $x, $y);
        $_col[$x][] = $color;
        if($color < '16777215') $all_color[$color] = $color;
    }
}
 
$n = array_sum($all_color) / count($all_color);
 
foreach ($_col as $key=>$val)
{
    foreach ($val as $k=>$v)
        $col[$key] .= $v < $n ? '1':' ';
}
 
// 去多余行列
foreach ($_col as $key=>$val)
    if(array_sum($val) < 1) unset($col[$key]);
 
 
foreach ($col as $key=>$val)
{
    $val = trim($val);
    if(empty($val)) unset($col[$key]);
}
 
echo '<pre>';
print_r($col);

?>