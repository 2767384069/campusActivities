<?php 
//require_once '../include.php';
/**
 * 添加活动
 * @return string
 */
function addAct(){
	$arr=$_POST;
	$arr['pubTime']=time();
	if(isset($_SESSION['adminName'])){
		$arr['adminName']=$_SESSION['adminName'];
	}elseif(isset($_COOKIE['adminName'])){
		$arr['adminName']=$_COOKIE['adminName'];
	}
	$path="./uploads";
	$filesname=uploadFile($path);
	
	$arr['labelImg']=$filesname;
	//$arr['readNum']=0;
	//$arr['praiseNum']=0;
	
	$a=insert("campus_act",$arr);
	//print_r($a);
	//die();
	
	if($a){
		$mes="<p>添加成功！</p><a href='addAct.php' target='mainFrame'>继续添加</a>|<a href='listAct.php' target='mainFrame'>查看商品列表</a>";
	}else {
		if(file_exists("uploads/".$arr['labelImg'])){
			unlink("uploads/".$arr['labelImg']);
		}
		$mes="<p>添加失败！</p><a href='addAct.php' target='mainFrame'>重新添加</a>";
	}
	return $mes;
}

function delAct($id){
	$where="id={$id}";
	$row=getActById($id);
	$where1="actId={$id}";
	$res1=delete("act_rev",$where1);
	if(file_exists("uploads/".$row['labelImg'])){
		unlink("uploads/".$row['labelImg']);
	}
	$res=delete("campus_act",$where);
	if($res&&$res1){
		$mes="删除成功!<br/><a href='listAct.php' target='mainFrame'>查看活动列表</a>";
	}else {
		$mes="删除失败!<br/><a href='listAct.php' target='mainFrame'>重新删除</a>";
	}
	return $mes;
}

function editAct($id){
	$arr=$_POST;
	$arr['pubTime']=time();
	if(isset($_SESSION['adminName'])){
		$arr['adminName']=$_SESSION['adminName'];
	}elseif(isset($_COOKIE['adminName'])){
		$arr['adminName']=$_COOKIE['adminName'];
	}
	$path="./uploads";
	$filesname=uploadFile($path);
	
	$arr['labelImg']=$filesname;
	$arr['readNum']=0;
	$arr['praiseNum']=0;
	$where="id={$id}";
	if(update("campus_act",$arr,$where)){
		$mes="<p>编辑成功！</p><a href='listAct.php' target='mainFrame'>查看活动列表</a>";
	}else {
	  $mes="<p>编辑失败！</p><a href='listAct.php' target='mainFrame'>重新编辑</a>";
	}
	return $mes;
}

/**
 * 根据id得到活动的详细信息
 * @param int $id
 * @return array
 */
function getActById($id){
	$sql="select id,title,labelImg,content,cName,pubName,adminName,pubTime,readNum,praiseNum from campus_act where id={$id}";
	$row=fetchOne($sql);
	return $row;
}

/**
 * 根据id得到申请的详细信息
 * @param int $id
 * @return array
 */
function getApplyById($id){
	$sql="select * from act_apply where id={$id}";
	$row=fetchOne($sql);
	return $row;
}

/**
 * 根据评论actId得到活动
 * @return array
 */
function getActByRev($actid){
	$sql="select * from campus_act where id={$actid}";
	$row=fetchOne($sql);
	return $row;
}
/*删除评论*/
function delRev($id){
	$where="id={$id}";
	if(delete("act_rev",$where)){
		$mes="删除成功!<br/><a href='listRev.php' target='mainFrame'>查看评论列表</a>";
	}else {
		$mes="删除失败!<br/><a href='listRev.php' target='mainFrame'>重新删除</a>";
	}
	return $mes;
}
/*增加申请*/
function addApply(){
	$arr=$_POST;
	$arr['applyTime']=time();
	if(isset($_SESSION['userName'])){
		$arr['userName']=$_SESSION['userName'];
	}elseif(isset($_COOKIE['userName'])){
		$arr['userName']=$_COOKIE['userName'];
	}
	$path="./uploads";
	$filesname=uploadFile($path);
	
	$arr['applyImg']=$filesname;
	
	$a=insert("act_apply",$arr);
	
	if($a){
		$mes="<p>申请提交成功！我们将会在5个工作日内进行审核，您可以去“关于我们”页面查看结果。</p>";
	}else {
		if(file_exists("uploads/".$arr['applyImg'])){
			unlink("uploads/".$arr['applyImg']);
		}
		$mes="<p>很抱歉，网站出了点小故障，申请提交失败！</p>";
	}
	return $mes;
}
/*删除申请*/
function delApply($id){
	$where="id={$id}";
	$row=getApplyById($id);
	if(file_exists("../uploads/".$row['applyImg'])){
		unlink("../uploads/".$row['applyImg']);
	}
	$res=delete("act_apply",$where);
	if($res){
		$mes="删除成功!<br/><a href='listApply.php' target='mainFrame'>查看申请列表</a>";
	}else {
		$mes="删除失败!<br/><a href='listApply.php' target='mainFrame'>重新删除</a>";
	}
	return $mes;
}
