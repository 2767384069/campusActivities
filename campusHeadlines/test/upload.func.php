<?php 

function uploadFile($path="uploads",$allowExt=array("gif","jpeg","png","jpg","wbmp"),$maxSize=2097152,$imgFlag=true){
	if(!file_exists($path)){
		mkdir($path,0777,true);
	}
	
	$filename=$_FILES['myFile']['name'];
	$type=$_FILES['myFile']['type'];
	$tmp_name=$_FILES['myFile']['tmp_name'];
	$error=$_FILES['myFile']['error'];
	$size=$_FILES['myFile']['size'];
	
	if($error===UPLOAD_ERR_OK){
		$ext=getExt($filename);
			//检测文件的扩展名
			if(!in_array($ext,$allowExt)){
				exit("非法文件类型");
			}
			//校验是否是一个真正的图片类型
			if ($imgFlag){
				if(!getimagesize($tmp_name)){
					exit("不是真正的图片类型");
				}
			}
			//上传文件的大小
			if($size>$maxSize){
				exit("上传文件过大");
			}
			if(!is_uploaded_file($tmp_name)){
				exit("不是通过HTTP POST方式上传上来的");
			}
			$filename=getUniName().".".$ext;
			$destination=$path."/".$filename;
			if(move_uploaded_file($tmp_name,$destination)){
				$mes="文件上传成功";
			}else {
				$mes="文件移动失败";
			}
		}else {
			switch ($error){
				case 1:
					$mes="超过了配置文件上传文件的大小";//UPLOAD_ERR_INI_SIZE
					break;
				case 2:
					$mes="超过了表单设置上传文件的大小";//UPLOAD_ERR_FROM_SIZE
					break;
				case 3:
					$mes="文件部分被上传";//UPLOAD_ERR_PARTIAL
					break;
				case 4:
					$mes="没有文件被上传";//UPLOAD_ERR_NO_FILE
					break;
				case 6:
					$mes="没有找到临时目录";//UPLOAD_ERR_NO_TMP_DIR
					break;
				case 7:
					$mes="文件不可写";//UPLOAD_ERR_CANT_WRITE
					break;
				case 8:
					$mes="由于php的扩展程序中断了文件上传";//UPLOAD_ERR_EXTENSION
					break;
			}
			echo $mes;
		}
	return $filename;
}