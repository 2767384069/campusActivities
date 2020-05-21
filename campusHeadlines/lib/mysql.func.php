<?php 
error_reporting(E_ALL & ~E_NOTICE);
//require_once '../include.php';
/**
 * 连接数据库 
 * @return resource
 */
//连接方式  mysqli(面向对象)
function connect(){
	global $link;
	$link=new mysqli(DB_HOST,DB_USER,DB_PWD,DB_DBNAME) or die("数据库连接失败Error:".($link->connect_errno).":".($link->connect_error));
	//设置默认客户端字符集
	$link->set_charset(DB_CHARSET);
	
	return $link;
}

/**
 * 完成记录插入的操作
 * @param string $table
 * @param array $array
 * @return number
 */
function insert($table,$array){
 $link=new mysqli(DB_HOST,DB_USER,DB_PWD,DB_DBNAME) or die("数据库连接失败Error:".($link->connect_errno).":".($link->connect_error));
 $keys=join(",",array_keys($array));
 $vals="'".join("','",array_values($array))."'";
 $sql="insert {$table}($keys) values({$vals})";
 $link->query($sql);
 return $link->insert_id;
 }
	
//update imooc_admin set username='king' where id=1
/**
 * 记录的更新操作
 * @param string $table
 * @param array $array
 * @param string $where
 * @return number
 */
function update($table,$array,$where=null){
	$link=new mysqli(DB_HOST,DB_USER,DB_PWD,DB_DBNAME) or die("数据库连接失败Error:".($link->connect_errno).":".($link->connect_error));
    $str="";//声明变量
    foreach ($array as $key=>$val){
		if($str==null){
			$sep="";
		}else {
			$sep=",";
		}
		$str.=$sep.$key."='".$val."'";
	}
	$sql="update {$table} set {$str} ".($where==null?null:"where ".$where);
	$result=$link->query($sql);
	if($result){
	    return $link->affected_rows;
	}else {
		printf("Error: %s\n", $link->error);
		return false;
	}
}
function updatePraise($table,$num,$id){
	$link=new mysqli(DB_HOST,DB_USER,DB_PWD,DB_DBNAME) or die("数据库连接失败Error:".($link->connect_errno).":".($link->connect_error));
	$sql="update {$table} set praiseNum={$num} where id={$id}";
	$result=$link->query($sql);
	if($result){
		return $link->affected_rows;
	}else {
		printf("Error: %s\n", $link->error);
		return false;
	}
}

function updateRead($table,$num,$id){
	$link=new mysqli(DB_HOST,DB_USER,DB_PWD,DB_DBNAME) or die("数据库连接失败Error:".($link->connect_errno).":".($link->connect_error));
	$sql="update {$table} set readNum={$num} where id={$id}";
	$result=$link->query($sql);
	if($result){
		return $link->affected_rows;
	}else {
		printf("Error: %s\n", $link->error);
		return false;
	}
}

/**
 * 删除记录
 * @param string $table
 * @param string $where
 * @return number
 */

function delete($table,$where=null){
 $link=new mysqli(DB_HOST,DB_USER,DB_PWD,DB_DBNAME) or die("数据库连接失败Error:".($link->connect_errno).":".($link->connect_error));
 $where=$where==null?null:"where ".$where;
 $sql="delete from {$table} {$where}";
 $result=$link->query($sql);
 return $link->affected_rows;
 }

/**
 * 得到指定一条记录
 * @param string $sql
 * @param string $result_type
 * @return multitype
 */
function fetchOne($sql,$result_type=MYSQLI_BOTH){
	$link=new mysqli(DB_HOST,DB_USER,DB_PWD,DB_DBNAME) or die("数据库连接失败Error:".($link->connect_errno).":".($link->connect_error));
	$result=$link->query($sql);
	if (!$result) {
		printf("Error: %s\n", $link->error);
		exit();
	} 
	$row=$result->fetch_array($result_type);
	return $row;
}
/**
 * 得到结果集中所有记录...
 * @param string $sql
 * @param string $result_type
 * @return multitype
 */

function fetchAll($sql, $result_type = MYSQLI_BOTH) {
	$link = new mysqli ( DB_HOST, DB_USER, DB_PWD, DB_DBNAME ) or die ( "数据库连接失败Error:" . ($link->connect_errno) . ":" . ($link->connect_error) );
	$result = $link->query ( $sql );
	if (! $result) {
		printf ( "Error: %s\n", $link->error );
		exit ();
	}
	while ( @$row = $result->fetch_array ( $result_type ) ) {
		$rows [] = $row;
	}
	return $rows;
}

/**
 * 得到结果集中的记录条数
 * @param unknown $sql
 * @return unknown
 */

function getResultNum($sql){
 $link=new mysqli(DB_HOST,DB_USER,DB_PWD,DB_DBNAME) or die("数据库连接失败Error:".($link->connect_errno).":".($link->connect_error));
 $result=$link->query($sql);
 return $result->num_rows;
 }
 
 /**
  * 得到上一步插入记录的ID号
  * @return number
  */
 function getInsertId(){
 	//global $link;
 	$link=new mysqli(DB_HOST,DB_USER,DB_PWD,DB_DBNAME) or die("数据库连接失败Error:".($link->connect_errno).":".($link->connect_error));
    return $link->insert_id;
 }

