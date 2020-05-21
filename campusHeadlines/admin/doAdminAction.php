<?php 
//error_reporting(E_ALL & ~E_NOTICE);
require_once '../include.php';
$act=$_REQUEST['act'];
$id=$_REQUEST['id'];
$userName=$_REQUEST['userName'];
if($act=="logout"){
	logout();
}elseif ($act=="addAdmin"){
	$mes=addAdmin();
}elseif ($act=="editAdmin"){
	$mes=editAdmin($id);
}elseif ($act=="delAdmin"){
	$mes=delAdmin($id);
}elseif ($act=="addAct"){
	$mes=addAct();
}elseif ($act=="editAct"){
	$mes=editAct($id);
}elseif ($act=="delAct"){
	$mes=delAct($id);
}elseif ($act=="addUser"){
	$mes=addUser();
}elseif ($act=="delUser"){
	$mes=delUser($id);
}elseif ($act=="editUser"){
	$mes=editUser($id);
}elseif ($act=="delRev"){
	$mes=delRev($id);
}elseif ($act=="delApply"){
	$mes=delApply($id);
}elseif ($act=="addAdminbyUser"){
	$mes=addAdminbyUser($userName);
}
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>title</title>
</head>
<body>
<h3>
<?php 
if($mes){
	echo $mes;
}
?>
</h3>
</body>
</html>