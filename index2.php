<?php

require_once('weixin.class.php');
$weixin = new class_weixin();

if (!isset($_GET["code"])){
	$redirect_url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	$jumpurl = $weixin->oauth2_authorize($redirect_url, "snsapi_userinfo", "123");
	Header("Location: $jumpurl");exit(); // 一定要header退出否则会回调失败！！！
}else{
	$access_token_oauth2 = $weixin->oauth2_access_token($_GET["code"]);
	var_dump($access_token_oauth2);
	$userinfo = $weixin->oauth2_get_user_info($access_token_oauth2['access_token'], $access_token_oauth2['openid']);
	var_dump($userinfo);
	$userinfo = $weixin->get_user_info($access_token_oauth2['openid']);
	var_dump($userinfo);
}
?>
