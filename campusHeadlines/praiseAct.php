<?php
require_once 'include.php';

$actId=$_POST['actId'];
$text=$_POST['adddel'];
$sql="select * from campus_act where id=".$actId;
$row=fetchOne($sql);
if($text=='取消赞'){
	$num=intval($row['praiseNum'])+1;
	updatePraise("campus_act",$num,$actId);
}else {
	$num=intval($row['praiseNum'])-1;
	updatePraise("campus_act",$num,$actId);
}