<?php
include "../config/koneksi.php";

$cek=umenu_akses("?module=order",$_SESSION[sessid]);
if($cek==1 OR $_SESSION[leveluser]=='admin'){
echo "<li><a href='?module=order'><img src='img/icons/packs/fugue/16x16/ordermasuk.png'><b>Order Masuk</b>";
      include "order.php";
echo "</a></li>";
}
$cek=umenu_akses("?module=konfirmasi",$_SESSION[sessid]);
if($cek==1 OR $_SESSION[leveluser]=='admin'){
echo "<li>
      <a href='?module=konfirmasi'>
	  <img src='img/icons/packs/fugue/16x16/pembayaran.png'><b>Konfirmasi Pembayaran</b>";
      include "konfirmasi.php";
echo "</a></li>";
}

$cek=umenu_akses("?module=hubungi",$_SESSION[sessid]);
if($cek==1 OR $_SESSION[leveluser]=='admin'){
echo "<li><a href='?module=hubungi'>
      <img src='img/icons/packs/fugue/16x16/kontak.png'><b>Pesan Masuk</b>";
      include "pesan.php"; 
echo "</a></li>";
}
$cek=umenu_akses("?module=testimonial",$_SESSION[sessid]);
if($cek==1 OR $_SESSION[leveluser]=='admin'){
echo "<li><a href='?module=testimonial'>
      <img src='img/icons/packs/fugue/16x16/testimoni.png'><b>Testimonial</b></a></li>";
}
?>
