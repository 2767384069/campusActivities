<?php 
require_once 'include.php';
$id=$_REQUEST['id'];
$act=$_REQUEST['act'];
$aact=$_POST['aact'];
if($act==="reg"){
	$mes=reg();
}elseif($act==="login"){
	$mes=login();
}elseif($act==="userOut"){
	userOut();
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Insert title here</title>
</head>
<body>
<?php 
	if($mes){
		echo $mes;
	}
?>
</body>
</html>