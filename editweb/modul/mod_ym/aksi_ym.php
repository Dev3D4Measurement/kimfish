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

$module=$_GET[module];
$act=$_GET[act];
$id=$_POST[id];

// Hapus YM
if ($module=='ym' AND $act=='hapus'){
  mysql_query("DELETE FROM mod_ym WHERE id='$_GET[id]'");
  header('location:../../media.php?module='.$module);
}

// Input YM
elseif ($module=='ym' AND $act=='input'){
  mysql_query("INSERT INTO mod_ym(nama,
                                  username,
                                  ym) 
						   VALUES('$_POST[nama]',
						          '$_SESSION[namauser]',
						          '$_POST[ym]')");
  header('location:../../media.php?module='.$module);
}

// Update YM
elseif ($module=='ym' AND $act=='update'){
  mysql_query("UPDATE mod_ym SET nama = '$_POST[nama]',
                                   ym = '$_POST[ym]' 
							WHERE id  = '$id'");
  header('location:../../media.php?module='.$module);
} 
} 
?>
