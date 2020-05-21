<?php 
function reg(){
	$arr=$_POST;
	$arr['password']=md5($_POST['password']);
	
//	print_r($arr);exit;
	if(insert("act_user", $arr)){
		$mes="注册成功!<br/><a href='login.php'>现在登录</a>|<a href='index.php'>直接进入网站首页</a>";
	}else{
		$mes="注册失败!<br/><a href='reg.php'>重新注册</a>|<a href='index.php'>直接进入网站首页</a>";
	}
	return $mes;
}
function login(){
	$userName=$_POST['userName'];
	//addslashes():使用反斜线引用特殊字符
	$userName=addslashes($userName);
	//$username=$link->real_escape_string($username);
	$password=md5($_POST['password']);
	$verify=$_POST['verify'];
	$verify1=$_SESSION['verify'];
	if($verify==$verify1){
	  $sql="select * from act_user where userName='{$userName}' and password='{$password}'";
	  $row=fetchOne($sql);
	  $sql2="select * from act_admin where adminName='{$userName}' and password='{$password}'";
	  $row2=fetchOne($sql2);
	  if($row){
	  	$_SESSION['loginFlag']=$row['id'];
		$_SESSION['userName']=$row['userName'];
		alertMes("登录成功","index.php");
	  }elseif($row2){
	  	$_SESSION['loginFlag']=$row2['id'];
	  	$_SESSION['userName']=$row2['adminName'];
	  	alertMes("登录成功","index.php");
	  }else{
	  	alertMes("登录失败，重新登录","login.php");
	  }
	  return $mes;
	}else {
		alertMes("验证码错误","login.php");
	}
}

function userOut(){
	$_SESSION=array();
	if(isset($_COOKIE[session_name()])){
		setcookie(session_name(),"",time()-1);
	}
	if(isset($_COOKIE['userId'])){
		setcookie("userId","",time()-1);
	}
	if(isset($_COOKIE['userName'])){
		setcookie("userName","",time()-1);
	}
	session_destroy();
	header("location:index.php");
}




