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

// Hapus konfirmasi
if ($module=='konfirmasi' AND $act=='hapus'){
  mysql_query("DELETE FROM konfirmasi WHERE id_konfirmasi='$_GET[id]'");
  header('location:../../media.php?module='.$module);
}
}
?>