<?php
require_once '../include.php';
$adminName=$_POST['adminName'];
$adminName=addslashes($adminName);
$password=md5($_POST['password']);
//$password=$_POST['password'];
$verify=$_POST['verify'];
$verify1=$_SESSION['verify'];
$autoFlag=$_POST['autoFlag'];
if($verify==$verify1){
	$sql="select * from act_admin where adminName='{$adminName}' and password='{$password}'";
	$row=checkAdmin($sql);
	//var_dump($row);
	//die();
	if($row){
		//如果选了一周内自动登录
		if($autoFlag){
			setcookie("adminId",$row['id'],time()+7*23*3600);
			setcookie("adminName",$row['adminName'],time()+7*24*3600);
		}
		$_SESSION['adminName']=$row['adminName'];
		$_SESSION['adminId']=$row['id'];
		//header("location:index.php");
		alertMes("登录成功","index.php");
	}else {
		alertMes("登录失败，重新登录","login.php");
	}
}else {
	alertMes("验证码错误","login.php");
}