<?php
header("Content-type:application/json");
session_start();
if(isset($_SESSION["username"])){

	// 数据库配置
	include '../MySql.php';

	// 创建连接
	$conn = new mysqli($db_url, $db_user, $db_pwd, $db_name);

	// 获取数据
	$hm_id = $_GET["hmid"];

	if(empty($hm_id)){
		$result = array(
			"result" => "101",
			"msg" => "非法请求"
		);
	}else{
		// 生成网址
		$SERVER='http://'.$_SERVER['SERVER_NAME'].$_SERVER["REQUEST_URI"];
		$url = dirname(dirname($SERVER))."/index.php?hmid=".$hm_id;
		$result = array(
			"result" => "100",
			"msg" => "生成成功",
			"url" => $url
		);
	}
	// 返回结果
	echo json_encode($result,JSON_UNESCAPED_UNICODE);
}else{
	$result = array(
		"result" => "102",
		"msg" => "未登录"
	);
	// 未登录
	echo json_encode($result,JSON_UNESCAPED_UNICODE);
}
?>