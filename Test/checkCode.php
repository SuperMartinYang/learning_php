<?php
// require dirname(__FILE__).'/include/common.inc.php';//这是在cms2008下面做的测试
header("content-type:text/html; charset=utf-8;");
    session_start();//开启缓存
    if (isset($_SESSION['time']))//判断缓存时间
    {
        session_id();
        $_SESSION['time'];
    }
    else
    {
        $_SESSION['time'] = date("Y-m-d H:i:s");
    }
    $_SESSION['mcode']=$_GET['mcode'];//将content的值保存在session中
////如果得到手机号
if($mobile) {
//  echo "2";//得到手机号
//  echo $_SESSION['mcode'];//测试得到的验证码
//  echo '<br/>';
    if((strtotime($_SESSION['time'])+60)<time()) {//将获取的缓存时间转换成时间戳加上60秒后与当前时间比较，小于当前时间即为过期
        session_destroy();
        unset($_SESSION);
        header('content-type:text/html; charset=utf-8;');
        echo '<script>alert("验证码已过期，请重新获取！");</script>';
    }
    else{
    $mcode=$_SESSION['mcode'];
    $post_data = array();
    $post_data['username'] = "test";//用户名
    $post_data['password'] = "test";//密码
    $post_data['mobile'] = $mobile;//手机号，多个号码以分号分隔，如：13407100000;13407100001;13407100002
    $post_data['content'] = urlencode("您本次的验证码是：".$mcode);//内容，如为中文一定要使用一下urlencode函数
    $post_data['extcode'] = "";//扩展号，可选
    $post_data['senddate'] = "";//发送时间，格式：yyyy-MM-dd HH:mm:ss，可选
    $post_data['batchID'] = "";//批次号，可选
    $url='http://116.213.72.20/SMSHttpService/send.aspx';
    $o="";
    foreach ($post_data as $k=>$v)
    {
        $o.= "$k=".$v."&";
    }
    $post_data=substr($o,0,-1);
    $this_header = array("content-type: application/x-www-form-urlencoded;charset=UTF-8");
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER,$this_header);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_URL,$url);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($ch);//返回相应的标识，具体请参考我方提供的短信API文档
    curl_close($ch);
//  echo $result;
    }
}
?>