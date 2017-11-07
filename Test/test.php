<?php session_start()?>
<!DOCTYPE html>
<html>
  <head>
   <meta chartset="utf-8">
  </head>
  <body>
     <form method="post"  action="form.php">
       <p>验证码图片：<img border="1" src="checkCode.php?r="<?php echo rand();?> width="100" height="30"  /></p>

       <p>输入内容：<input type="text" name="autocode" value="" /></p>
    <p><input type="submit"  value="提交" style="padding:6px 20px;"/></p>


     </form>
  </body>


</html>