<?php
include "../config/koneksi.php";

$cek=umenu_akses("?module=logo",$_SESSION[sessid]);
if($cek==1 OR $_SESSION[leveluser]=='admin'){ 
echo "<li><a href='?module=logo'><img src='img/icons/packs/fugue/16x16/logo.png'><b>Logo Website</b></a></li>";
}

$cek=umenu_akses("?module=templates",$_SESSION[sessid]);
if($cek==1 OR $_SESSION[leveluser]=='admin'){ 
echo "<li><a href='?module=templates'><img src='img/icons/packs/fugue/16x16/templates.png'><b>Template Website</b></a></li>";
}

$cek=umenu_akses("?module=poling",$_SESSION[sessid]);
if($cek==1 OR $_SESSION[leveluser]=='admin'){ 
echo "<li><a href='?module=poling'><img src='img/icons/packs/fugue/16x16/chart.png'><b>Jajak Pendapat</b></a></li>";
}

$cek=umenu_akses("?module=header",$_SESSION[sessid]);
if($cek==1 OR $_SESSION[leveluser]=='admin'){
echo "<li><a href='?module=header'><img src='img/icons/packs/fugue/16x16/header.png'><b>Header Website</b></a></li>";
}
$cek=umenu_akses("?module=promo",$_SESSION[sessid]);
if($cek==1 OR $_SESSION[leveluser]=='admin'){
echo "<li><a href='?module=promo'><img src='img/icons/packs/fugue/16x16/banner.png'><b>Banner Promo</b></a></li>";
}
$cek=umenu_akses("?module=ym",$_SESSION[sessid]);
if($cek==1 OR $_SESSION[leveluser]=='admin'){
echo "<li><a href='?module=ym'><img src='img/icons/packs/fugue/16x16/ym.png'><b>Yahoo Messenger</b></a></li>";
}

$cek=umenu_akses("?module=bank",$_SESSION[sessid]);
if($cek==1 OR $_SESSION[leveluser]=='admin'){
echo "<li><a href='?module=bank'><img src='img/icons/packs/fugue/16x16/bank.png'><b>Rekening Bank</b></a></li>";
}

?>
