<?php
require_once 'include.php';

$arr=$_POST;
	
if(isset($_SESSION['userName'])){
	$arr['revName']=$_SESSION['userName'];
}elseif(isset($_COOKIE['userName'])){
	$arr['revName']=$_COOKIE['userName'];
}

$arr['pubTime']=time();
$arr['praiseNum']=0;
var_dump($arr);
insert("act_rev",$arr);
//print_r($arr);
//die();