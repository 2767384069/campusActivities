<?php 

function buildRandomString($type=1,$length=4){
		if($type == 1){
			$chars = join("",range(0,9));
		}elseif ($type == 2){
			$chars = join("",array_merge(range("a","z"),range("A","Z")));
		}else{
			$chars = join("",array_merge(range("a","z"),range("A","Z"),range(0,9)));
		}
		if($length > strlen ($chars)){
			exit("注释");
		}
	$chars = str_shuffle($chars);
	return substr($chars,0,$length);
}

/**
 * 生成唯一字符串
 * @return string
 */
function getUniName(){
	return md5(uniqid(microtime(true),true));
}

/**
 * 得到文件的扩展名
 * @param string $filename
 * @return string
 */
function getExt($filename){
	$file_extend = explode(".",$filename);
	return strtolower(end($file_extend));
}