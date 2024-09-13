<?php
include "../config/koneksi.php";

$cek=umenu_akses("?module=produk",$_SESSION[sessid]);
if($cek==1 OR $_SESSION[leveluser]=='admin'){
echo "<li><a href='?module=produk'><img src='img/icons/packs/fugue/16x16/produk1.png'><b>Produk</b></a></li>";
}

$cek=umenu_akses("?module=kategoriproduk",$_SESSION[sessid]);
if($cek==1 OR $_SESSION[leveluser]=='admin'){
echo "<li><a href='?module=kategoriproduk'><img src='img/icons/packs/fugue/16x16/kategori.png'><b>Kategori Produk</b></a></li>";
}

$cek=umenu_akses("?module=laporan",$_SESSION[sessid]);
if($cek==1 OR $_SESSION[leveluser]=='admin'){
echo "<li><a href='?module=laporan'><img src='img/icons/packs/fugue/16x16/laporan.png'><b>Laporan Keuangan</b></a></li>";
}

$cek=umenu_akses("?module=kota",$_SESSION[sessid]);
if($cek==1 OR $_SESSION[leveluser]=='admin'){
echo "<li><a href='?module=kota'><img src='img/icons/packs/fugue/16x16/kota.png'><b>Kota</b></a></li>";
}

$cek=umenu_akses("?module=propinsi",$_SESSION[sessid]);
if($cek==1 OR $_SESSION[leveluser]=='admin'){
echo "<li><a href='?module=propinsi'><img src='img/icons/packs/fugue/16x16/propinsi.png'><b>Propinsi</b></a></li>";
}

$cek=umenu_akses("?module=ongkoskirim",$_SESSION[sessid]);
if($cek==1 OR $_SESSION[leveluser]=='admin'){
echo "<li><a href='?module=ongkoskirim'><img src='img/icons/packs/fugue/16x16/ongkos.png'><b>Ongkos Kirim</b></a></li>";
}

$cek=umenu_akses("?module=pengiriman",$_SESSION[sessid]);
if($cek==1 OR $_SESSION[leveluser]=='admin'){
echo "<li><a href='?module=pengiriman'><img src='img/icons/packs/fugue/16x16/pengiriman.png'><b>Jasa Pengiriman</b></a></li>";
}

$cek=umenu_akses("?module=pemesanan",$_SESSION[sessid]);
if($cek==1 OR $_SESSION[leveluser]=='admin'){
echo "<li><a href='?module=pemesanan'><img src='img/icons/packs/fugue/16x16/door-open-in.png'><b>Cara Pemesanan</b></a></li>";
}

$cek=umenu_akses("?module=download",$_SESSION[sessid]);
if($cek==1 OR $_SESSION[leveluser]=='admin'){
echo "<li><a href='?module=download'><img src='img/icons/packs/fugue/16x16/download.png'><b>Download Katalog</b></a></li>";}

?>
