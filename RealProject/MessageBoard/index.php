<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>用户登录</title>
<script language="JavaScript">
function InputCheck(form1)
{
  if (form1.nickname.value == "")
  {
    alert("请输入您的昵称。");
    form1.nickname.focus();
    return (false);
  }
  if (form1.content.value == "")
  {
    alert("留言内容不可为空。");
    form1.content.focus();
    return (false);
  }
}
</script>

</head>

<body>
<form id="form1" name="form1" method="post" action="submiting.php" onSubmit="return InputCheck(this)">
<h3>发表留言</h3>
<p>
<label for="title">昵&nbsp;&nbsp;&nbsp;&nbsp;称:</label>
<input id="nickname" name="nickname" type="text" /><span>(必须填写，不超过16个字符串)</span>
</p>
<p>
<label for="title">电子邮件:</label>
<input id="email" name="email" type="text" /><span>(非必须，不超过60个字符串)</span>
</p>
<p>
<label for="title">留言内容:</label>
<textarea id="content" name="content" cols="50" rows="8" ></textarea>
</p>
<input type="submit" name="submit" value="  确 定  " />
</form>
</body>
</html>