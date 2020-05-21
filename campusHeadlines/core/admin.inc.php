<?php 
//error_reporting(E_ALL & ~E_NOTICE);
/**
 * 检查管理员是否存在
 * @param unknown $sql
 * @return unknown
 */
function checkAdmin($sql){
	return fetchOne($sql);
}
/**
 * 检测是否有管理员登录
 */
function checkLogined(){
	if($_SESSION['adminName']=="" && $_COOKIE['adminName']==""){
		alertMes("请先登录","login.php");
	}
	/* if($_SESSION['adminId']==""){
		alertMes("请先登录","login.php");
	} */ 
}
/**
 * 检测是否是超级管理员登录
 */
function checkSuper(){
	if(isset($_SESSION['adminName'])){
		$adminname= $_SESSION['adminName'];
	}elseif(isset($_COOKIE['adminName'])){
		$adminname=$_COOKIE['adminName'];
	}
	$where="adminName='{$adminname}'";
	$sql="select * from act_admin where {$where}";
	$row=fetchOne($sql);
	$issuper=$row['isSuper'];
	return $issuper;
}

/**
 * 得到所有的管理员
 * @return array
 */
function getAllAdmin(){
	$sql="select id,adminName,isSuper,email from act_admin";
	$rows=fetchAll($sql);
	return $rows;
}

function getAdminByPage($page,$pageSize=2){
	$sql="select * from act_admin";
	global $totalRows;
	$totalRows=getResultNum($sql);
	global $totalPage;
	$totalPage=ceil($totalRows/$pageSize);
	if($page<1||$page==null||!is_numeric($page)){
		$page=1;
	}
	if($page>=$totalPage)$page=$totalPage;
	$offset=($page-1)*$pageSize;
	$sql="select id,adminName,isSuper,email from act_admin limit {$offset},{$pageSize}";
	$rows=fetchAll($sql);
	return $rows;
}
/**
 * 编辑管理员
 * @param int $id
 * @return string
 */
function editAdmin($id){
	$arr=$_POST;
	$arr['password']=md5($_POST['password']);
	if(update("act_admin",$arr,"id={$id}")){
		$mes="编辑成功！<br/><a href='listAdmin.php'>查看管理员列表</a>";
	}else {
		$mes="编辑失败！<br/><a href='listAdmin.php>请重新修改</a>";
	}
	return $mes;
}

/**
 * 删除管理员的操作
 * @param int $id
 * @return string
 */
function delAdmin($id){
	if(delete("act_admin","id={$id}")){
		$mes="删除成功！<br/><a href='listAdmin.php'>查看管理员列表</a>";
	}else {
		$mes="删除失败！<br/><a href='listAdmin.php'>请重新删除</a>";
	}
	return $mes;
}
/**
 * 添加管理员
 * @return string
 */
function addAdmin(){
	$arr=$_POST;
	$arr['password']=md5($_POST['password']);
	if(insert("act_admin",$arr)){
		$mes="添加成功！</br><a href='addAdmin.php'>继续添加</a>|<a href='listAdmin.php'>查看管理员列表</a>";
	}else {
		$mes="添加失败！<br/><a href='addAdmin.php'>重新添加</a>";
	}
	return $mes;
}

function addAdminbyUser($userName){
	$where="userName='{$userName}'";
	$sql="select * from act_user where {$where}";
	$row=fetchOne($sql);
	$arr['adminName']=$row['userName'];
	$arr['password']=$row['password'];
	$arr['email']=$row['email'];
	$arr['isSuper']=0;
	if(insert("act_admin",$arr)){
		$mes="已批准！</br><a href='listApply.php'>查看申请列表</a>";
	}else {
		$mes="操作失败！<br/><a href='listApply.php'>查看申请列表</a>";
	}
	return $mes;
}

/**
 * 注销管理员
 */
function  logout(){
	$_SESSION=array();
	if(isset($_COOKIE[session_name()])){
		setcookie(session_name(),"",time()-1);
	}
	if(isset($_COOKIE['adminId'])){
		setcookie("adminId","",time()-1);
	}
	if(isset($_COOKIE['adminName'])){
		setcookie("adminName","",time()-1);
	}
	session_destroy();
	header("location:login.php");
}

/**
 * 根据管理员名称得到该管理员发布的所有活动
 * @param unknown $adminname
 * @return unknown
 */
function getActByAdmin($adminname){
	$sql="select * from campus_act where adminName='{$adminname}'";
	$rows=fetchAll($sql);
	return $rows;
}

/**
 * 添加用户的操作
 * @return string
 */
function addUser(){
	$arr=$_POST;
	$arr['password']=md5($_POST['password']);
	//	print_r($arr);exit;
	if(insert("act_user", $arr)){
		$mes="添加成功!<br/><a href='addUser.php'>继续添加</a><a href='listUser.php'>查看列表</a>";
	}else{
		$mes="添加失败!<br/><a href='addUser.php'>重新添加</a>|<a href='listUser.php'>查看列表</a>";
	}
	return $mes;
}

/**
 * 删除用户的操作
 * @param unknown $id
 * @return string
 */
function delUser($id){
	if(delete("act_user","id={$id}")){
		$mes="删除成功！<br/><a href='listUser.php'>查看用户列表</a>";
	}else {
		$mes="删除失败！<br/><a href='listUser.php'>请重新删除</a>";
	}
	return $mes;
}

/**
 * 编辑用户的操作
 * @param unknown $id
 * @return string
 */
function editUser($id){
	$arr=$_POST;
	$arr['password']=md5($_POST['password']);
	if(update("act_user",$arr,"id={$id}")){
		$mes="编辑成功！<br/><a href='listUser.php'>查看用户列表</a>";
	}else {
		$mes="编辑失败！<br/><a href='listUser.php>请重新修改</a>";
	}
	return $mes;
}