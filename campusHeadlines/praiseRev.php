<?php
require_once 'include.php';

$id=$_POST['id'];
$my=intval($_POST['my']);
$sql="select * from act_rev where id={$id}";
$row=fetchOne($sql);
if($my==0){
	$num=intval($row['praiseNum'])+1;
	updatePraise("act_rev",$num,$id);
	$my=1;
	echo $my;
}else {
	$num=intval($row['praiseNum'])-1;
	updatePraise("act_rev",$num,$id);
	$my=0;
	echo $my;
}