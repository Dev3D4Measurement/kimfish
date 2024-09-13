<?php
include "../config/koneksi.php";

$cek=umenu_akses("?module=identitas",$_SESSION[sessid]);
if($cek==1 OR $_SESSION[leveluser]=='admin'){
echo "<li><a href='?module=identitas'><img src='img/icons/packs/fugue/16x16/information.png'><b>Konfirgurasi Website</b></a></li>"; 
}

$cek=umenu_akses("?module=menuutama",$_SESSION[sessid]);
if($cek==1 OR $_SESSION[leveluser]=='admin'){
echo "<li><a href='?module=menuutama'><img src='img/icons/packs/fugue/16x16/menuutama.png'><b>Menu Utama</b></a></li>";
}

$cek=umenu_akses("?module=submenu",$_SESSION[sessid]);
if($cek==1 OR $_SESSION[leveluser]=='admin'){
echo "<li><a href='?module=submenu'><img src='img/icons/packs/fugue/16x16/submenu.png'><b>Sub Menu</b></a></li>";
}

$cek=umenu_akses("?module=profil",$_SESSION[sessid]);
if($cek==1 OR $_SESSION[leveluser]=='admin'){
echo "<li><a href='?module=profil'><img src='img/icons/packs/fugue/16x16/profil.png'><b>Edit Profil</b></a></li>";
}

$cek=umenu_akses("?module=welcome",$_SESSION[sessid]);
if($cek==1 OR $_SESSION[leveluser]=='admin'){
echo "<li><a href='?module=welcome'><img src='img/icons/packs/fugue/16x16/welcome.png'><b>Selamat Datang</b></a></li>";
}
$cek=umenu_akses("?module=halamanstatis",$_SESSION[sessid]);
if($cek==1 OR $_SESSION[leveluser]=='admin'){ 
echo "<li><a href='?module=halamanstatis'><img src='img/icons/packs/fugue/16x16/halaman.png'><b>Halaman Baru</b></a></li>";
}
$cek=umenu_akses("?module=berita",$_SESSION[sessid]);
if($cek==1 OR $_SESSION[leveluser]=='admin'){ 
echo "<li><a href='?module=berita'><img src='img/icons/packs/fugue/16x16/berita.png'><b>Berita</b></a></li>";
}
$cek=umenu_akses("?module=user",$_SESSION[sessid]);
if($cek==1 OR $_SESSION[leveluser]=='admin'){ 
echo "<li><a href='?module=user'><img src='img/icons/packs/fugue/16x16/user-white.png'><b>Manajemen User</b></a></li>";
}

$cek=umenu_akses("?module=modul",$_SESSION[sessid]);
if($cek==1 OR $_SESSION[leveluser]=='admin'){ 
echo "<li><a href='?module=modul'><img src='img/icons/packs/fugue/16x16/modul.png'><b>Manajemen Modul</b></a></li>";
}


?>
