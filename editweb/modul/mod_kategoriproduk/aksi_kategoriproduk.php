<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
     echo "<link href='../../css/style.css' rel='stylesheet' type='text/css'>
 <body class='special-page'>
  <div id='container'>
  <section id='error-number'>
  
  <img src='../../img/lock.png'>
  <h1>MODUL TIDAK DAPAT DIAKSES</h1>
  
  <p><span class style=\"font-size:14px; color:#ccc;\">Untuk mengakses modul, Anda harus login dahulu!</p></span><br/>
  
  </section>
  
  <section id='error-text'>
  <p><a class='button' href='../../index.php'> <b>LOGIN</b> </a></p>
  </section>
  </div>";
}
else{
include "../../../config/koneksi.php";
include "../../../config/fungsi_seo.php";

$module=$_GET[module];
$act=$_GET[act];

// Hapus Kategori
if ($module=='kategoriproduk' AND $act=='hapus'){
  mysql_query("DELETE FROM kategoriproduk WHERE id_kategori='$_GET[id]'");
  header('location:../../media.php?module='.$module);
}
// Input kategoriproduk
if ($module=='kategoriproduk' AND $act=='input'){
  $kategori_seo = seo_title($_POST['nama_kategori']);
  mysql_query("INSERT INTO kategoriproduk(nama_kategori,
                                    kategori_seo,
									username) 
							VALUES('$_POST[nama_kategori]',
							       '$kategori_seo',
								   '$_SESSION[namauser]')");
  header('location:../../media.php?module='.$module);
}

// Update kategoriproduk
elseif ($module=='kategoriproduk' AND $act=='update'){
  $kategori_seo = seo_title($_POST['nama_kategori']);
  
  mysql_query("UPDATE kategoriproduk SET nama_kategori  ='$_POST[nama_kategori]', 
                                         kategori_seo   ='$kategori_seo'
                                     WHERE id_kategori = '$_POST[id]'");
  header('location:../../media.php?module='.$module);
}
}
?>
