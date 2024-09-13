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

// Hapus propinsi
if ($module=='propinsi' AND $act=='hapus'){
 mysql_query("DELETE FROM propinsi WHERE id_propinsi='$_GET[id]'");
  header('location:../../media.php?module='.$module);
}

// Input propinsi
elseif ($module=='propinsi' AND $act=='input'){
   mysql_query("INSERT INTO propinsi(nama_propinsi,
                                 id_propinsi,
								 username) 
						VALUES('$_POST[nama_propinsi]',
						       '$_POST[propinsi]',
							   '$_SESSION[namauser]')");
  header('location:../../media.php?module='.$module);
}

// Update propinsi
elseif ($module=='propinsi' AND $act=='update'){
   mysql_query("UPDATE propinsi SET nama_propinsi = '$_POST[nama_propinsi]', 
                                id_propinsi = '$_POST[propinsi]'
							  WHERE id_propinsi = '$_POST[id]'");
  header('location:../../media.php?module='.$module);
}
}
?>
