<?php
session_start();
function timer(){
	$time=800;
	$_SESSION[timeout]=time()+$time;
}
function cek_belanja(){
	$timeout=$_SESSION[timeout];
	if(time()<$timeout){
		timer();
		return true;
	}else{
		unset($_SESSION[timeout]);
		return false;
	}
}
?>
