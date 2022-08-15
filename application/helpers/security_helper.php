<?php 


function validationToken($value){
	if ($value!=token()){
		exit(json_encode(array('result'=>false,'message'=>'Token is invalid!')));
	}
}

function _md5($string){
	$md5 = md5($string);
	return strlen($md5).$md5.strlen($md5);
}

function _getDate($custom = null)
{
	date_default_timezone_set('Asia/Jakarta');
	($custom == null) ? $d = date('Y/m/d') : $d = date($custom);
	return $d;
}

function _getTime($custom = null)
{
	date_default_timezone_set('Asia/Jakarta');
	$t = ($custom == null) ? date('H:i') : date($custom);
	return $t;
}

function token(){
	return 'A3kf3opk23ln4324n32k4nl34o3i2j4lk';
}

function _randomStr($length = 10)
{
	$c = '0123456789abcdefghijklmnopqrstuvwxyz';
	$cL = strlen($c);
	$rS = '';
	for ($i = 0; $i < $length; $i++) {
		$rS .= $c[rand(0, $cL - 1)];
	}
	return $rS;
}
