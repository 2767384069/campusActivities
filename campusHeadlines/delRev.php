<?php
require_once 'include.php';

$id=$_POST['revId'];
var_dump($id);
$where="id={$id}";
delete("act_rev",$where);