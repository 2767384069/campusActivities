<?php 
function verifyImage($type = 1,$length = 4,$pixel=0,$line=0,$sess_name = "verify"){
	// 注释
	$width = 80;
	$height = 28;
	$image = imagecreatetruecolor ( $width, $height );
	$white = imagecolorallocate ( $image, 255, 255, 255 );
	$black = imagecolorallocate ( $image, 0, 0, 0 );
	// 注释
	imagefilledrectangle ( $image, 1, 1, $width - 2, $height - 2, $white );
	$chars = buildRandomString ( $type, $length );
	//var_dump($chars);
	//die();
	$_SESSION [$sess_name] = $chars;
	$fontfiles = array (
			'D:\web\php\apache\Apache24\htdocs\shopImooc\shopImooc\fonts\SIMLI.TTF',
			
			'D:\web\php\apache\Apache24\htdocs\shopImooc\shopImooc\fonts\SIMYOU.TTF',
			'D:\web\php\apache\Apache24\htdocs\shopImooc\shopImooc\fonts\STZHONGS.TTF'
	);
	for($i = 0; $i < $length; $i ++) {
		$size = mt_rand ( 14, 18 );
		$angle = mt_rand (-15, 15 );
		$x = 5 + $i * $size;
		$y = mt_rand ( 20, 26 );
		$fontfile =$fontfiles [mt_rand ( 0, count ( $fontfiles ) - 1 )];
		
		//$fontfile = "../fonts/" . $fontfiles [mt_rand ( 0, count ( $fontfiles ) - 1 )];
		$color = imagecolorallocate ( $image, mt_rand ( 50, 90 ), mt_rand ( 80, 200 ), mt_rand ( 90, 180 ) );
		$text = substr ( $chars, $i, 1 );
		imagettftext ( $image, $size, $angle, $x, $y, $color, $fontfile, $text );
		//imagettftext($image,mt_rand(20,24),mt_rand(-60,60),(40*$i+20),mt_rand(30,35),$fontcolor,$fontface,$cn);
		
	}
	//ob_clean (); // 注释
	if ($pixel) {
		for($i = 0; $i < 50; $i ++) {
			imagesetpixel ( $image, mt_rand ( 0, $width - 1 ), mt_rand ( 0, $height - 1 ), $black );
		}
	}
	if ($line) {
		for($i = 1; $i < $line; $i ++) {
			$color = imagecolorallocate ( $image, mt_rand ( 50, 90 ), mt_rand ( 80, 200 ), mt_rand ( 90, 180 ) );
			imageline ( $image, mt_rand ( 0, $width - 1 ), mt_rand ( 0, $height - 1 ), mt_rand ( 0, $width - 1 ), mt_rand ( 0, $height - 1 ), $color );
		}
	}
	header ( 'Content-Type:image/gif' );
	imagegif ( $image );
	imagedestroy ( $image );
}
//verifyImage(1,4,10,5);
