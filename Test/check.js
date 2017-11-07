//检测电话号码是否正确
function check_mobile(tel){
	var tel=mobile.replace(/^\s*|\s*$/g,'');
	var length=tel.length;
	if (length==0)
	{
		alert('手机号码不能为空...');
		$('#Submit').attr('disabled','disabled');
		return;
	}
	$a=preg_match('/^((1[3|4|5|8])[0-9]{9})$/',tel);
	if ($a)
	{
		$('#Submit').attr('disabled','');
		return;
	}
	else{
		alert('手机号码格式不正确请重新输入...');
		$('#Submit').attr('disabled','dosabled');
		return;
	}

}


//检测密码
function check_password(password){
	var password=password.replace(/^\s*|\s*$/g,'');
	var length=password.length;
	if (length==0)
	{
		alert('密码不能为空...')
		$('#Submit').attr('disabled','disabled');
		return;
	}
}

//检测确认密码
function check_conform_password(p2){
	var p1=$('#password').val();
	var p2=$('#conform_password').val();
	if (p2!=p1)
	{
		alert('两次输入密码不一致...');
		$('#Submit').attr('disabled','disabled');
		return;
	}
	else{
		$('#Submit').attr('disabled','');
		return;
	}
}


//选中复选框
//function check_box(){
//	
//}
////检查用户名
//function check_username(username){
//	alert(username);
//	exit;
//	var username=username.replace(/^\s*|\s*$/g,'');
//	var length=username.length;
//	if (length==0)//用户名为空的时候
//	{
//		$('#username_notice').html('用户名不能为空');
//		$('#Submit').attr('disabled','disabled');
//		return;
//	}
//	else if (length<2)
//	{
//		$('#username_notice').html('用户名位大于2位的');
//		$('#Submit').attr('disabled','disabled');
//		return;
//	}
//	else if (length>4)
//	{
//		$('#username_notice').html('用户名不能大于！');
//		$('#Submit').attr('disabled','disabled');
//		return;
//	}
//	else{
//		$('#username_notice').html('请继续填写');
//		$('#Submit').attr('disabled','');
//		return;
//	}
//		//正则匹配中文名字/[\x{4e00}-\x{9fa5}]+/u
//		$a=preg_match('/^[a-zA-Z][a-zA-Z0-9]\w{2,19}$/',username);
//		if($a) {
//			$('#username_notice').html('姓名正确请继续');
//			$('#Submit').attr('disabled','');
//			return;
//		}
//		else{
//			$('#username_notice').html('姓名格式不正确');
//			$('#Submit').attr('disabled','dosabled');
//			return;
//		}
//
//
//}
//
////检测公司名称
//function check_company(company){
////	alert(company);
////	exit;
//	var company=company.replace(/^\s*|\s*$/g,'');
//	var clength=company.length;
////	alert(clength);
//	if (clength==0)
//	{
//		$('#company_notice').html('公司名称不能为空');
//		$('#Submit').attr('disabled','disabled');
//		return;
//	}
//	if (clength<7)
//	{
//		$('#company_notice').html('公司名称不能小于7个汉字');
//		$('#Submit').attr('disabled','disabled');
//		return;
//	}
//	if (clength>20)
//	{
//		$('#company_notice').html('公司名称不能超过20个汉字');
//		$('#Submit').attr('disabled','disabled');
//		return;
//	}
//
//	$a=preg_match('/^[a-zA-Z][a-zA-Z0-9]\w{7,20}$/',company);
//		if($a) {
//			$('#company_notice').html('公司名称正确请继续');
//			$('#Submit').attr('disabled','');
//			return;
//		}
//		else{
//			$('#company_notice').html('公司名称格式不正确');
//			$('#Submit').attr('disabled','dosabled');
//			return;
//		}
//}
//
////检测城市
//function check_city(city){
////	alert(company);
////	exit;
//	var city=city.replace(/^\s*|\s*$/g,'');
//	var length=city.length;
////	alert(clength);
//	if (length==0)
//	{
//		$('#city_notice').html('城市名称不能为空');
//		$('#Submit').attr('disabled','disabled');
//		return;
//	}
//	if (clength<1)
//	{
//		$('#city_notice').html('城市名称不能小于1个汉字');
//		$('#Submit').attr('disabled','disabled');
//		return;
//	}
//	if (clength>4)
//	{
//		$('#city_notice').html('公司名称不能超过4个汉字');
//		$('#Submit').attr('disabled','disabled');
//		return;
//	}
//
//	$a=preg_match('/^[a-zA-Z][a-zA-Z0-9]\w{2,4}$/',company);
//		if($a) {
//			$('#city_notice').html('城市名称正确请继续');
//			$('#Submit').attr('disabled','');
//			return;
//		}
//		else{
//			$('#city_notice').html('城市名称格式不正确');
//			$('#Submit').attr('disabled','dosabled');
//			return;
//		}
//}
//
////检测地址是否正确
//function check_address(address){
////	alert(company);
////	exit;
//	var address=address.replace(/^\s*|\s*$/g,'');
//	var length=address.length;
////	alert(clength);
//	if (length==0)
//	{
//		$('#address_notice').html('地址不能为空');
//		$('#Submit').attr('disabled','disabled');
//		return;
//	}
//	if (clength<2)
//	{
//		$('#address_notice').html('地址不能小于1个汉字');
//		$('#Submit').attr('disabled','disabled');
//		return;
//	}
//	if (clength>30)
//	{
//		$('#address_notice').html('地址不能超过30个汉字');
//		$('#Submit').attr('disabled','disabled');
//		return;
//	}
//
//	$a=preg_match('/^[a-zA-Z][a-zA-Z0-9]\w{1,30}$/',company);
//		if($a) {
//			$('#address_notice').html('地址正确请继续');
//			$('#Submit').attr('disabled','');
//			return;
//		}
//		else{
//			$('#address_notice').html('地址格式不正确');
//			$('#Submit').attr('disabled','dosabled');
//			return;
//		}
//}