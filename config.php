<?php
	//error handler function
	function customError($errno, $errstr)
	 { 
	 echo "<b>Error:</b> [$errno] $errstr<br>";
	 }

	//set error handler
	set_error_handler("customError");
	
	ini_set('date.timezone','Asia/Shanghai');
//定义AppId，需要在微信公众平台申请自定义菜单后会得到
	define("AppId", "wxb9ef83d179085390");

//定义AppSecret，需要在微信公众平台申请自定义菜单后会得到	 
	define("AppSecret", "f5e3579229d0e1a33b3fd95c47a9832b");

	include("weixinmenu.class.php");//引入微信类

	$wechatObj = new WechatMenu();//实例化微信类
	echo "实例化结束，<br>";
	if(!$wechatObj){
		echo "创建wechatobj失败！<br>";	
	}
	

	$creatMenu = $wechatObj->creatMenu();//创建菜单

	echo "提交菜单完成";
	echo $creatMenu;
	echo "string";
?>
