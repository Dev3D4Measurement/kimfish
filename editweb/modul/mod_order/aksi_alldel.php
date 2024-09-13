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


$cek=$_POST[cek];
$jumlah=count($cek);
    
  for($i=0;$i<$jumlah;$i++){
  mysql_query("DELETE FROM orders WHERE id_orders='$cek[$i]'");
  }
  header('location:../../media.php?module=order');
  }
?>