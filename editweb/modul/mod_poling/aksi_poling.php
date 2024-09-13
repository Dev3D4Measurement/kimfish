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

// Hapus poling
if ($module=='poling' AND $act=='hapus'){
  mysql_query("DELETE FROM poling WHERE id_poling='$_GET[id]'");
  header('location:../../media.php?module='.$module);
}

// Input poling
elseif ($module=='poling' AND $act=='input'){
  mysql_query("INSERT INTO poling(pilihan,
                                  status, 
                                  aktif,
								  username) 
	                       VALUES('$_POST[pilihan]',
	                              '$_POST[status]',
                                '$_POST[aktif]',
								'$_SESSION[namauser]')");
  header('location:../../media.php?module='.$module);
}

// Update poling
elseif ($module=='poling' AND $act=='update'){
  mysql_query("UPDATE poling SET pilihan = '$_POST[pilihan]',
                                 status  = '$_POST[status]',
                                 aktif   = '$_POST[aktif]'  
                          WHERE id_poling = '$_POST[id]'");
  header('location:../../media.php?module='.$module);
}
}
?>
