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

// Hapus Kota
if ($module=='kota' AND $act=='hapus'){
 mysql_query("DELETE FROM kota WHERE id_kota='$_GET[id]'");
  header('location:../../media.php?module='.$module);
}

// Input Kota
elseif ($module=='kota' AND $act=='input'){
   mysql_query("INSERT INTO kota(nama_kota,
                                 id_propinsi,
								 username) 
						VALUES('$_POST[nama_kota]',
						       '$_POST[propinsi]',
							   '$_SESSION[namauser]')");
  header('location:../../media.php?module='.$module);
}

// Update Kota
elseif ($module=='kota' AND $act=='update'){
   mysql_query("UPDATE kota SET nama_kota = '$_POST[nama_kota]', 
                                id_propinsi = '$_POST[propinsi]'
							  WHERE id_kota = '$_POST[id]'");
  header('location:../../media.php?module='.$module);
}
}
?>
