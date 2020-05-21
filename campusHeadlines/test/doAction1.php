<?php
require_once '../lib/string.func.php';
require_once 'upload.func.php';
//print_r($_FILES);
//die();
$path="./uploads";
$mes=uploadFile($path);
echo $mes;
