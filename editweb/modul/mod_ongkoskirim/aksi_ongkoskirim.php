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

// Hapus Ongkos Kirim
if ($module=='ongkoskirim' AND $act=='hapus'){
 mysql_query("DELETE FROM ongkos_kirim WHERE id_ongkir='$_GET[id]'");
  header('location:../../media.php?module='.$module);
}

// Input Ongkos Kirim
elseif ($module=='ongkoskirim' AND $act=='input'){
   mysql_query("INSERT INTO ongkos_kirim(id_kota,
										 id_jasa,
										 biaya,
										 username) 
							      VALUES('$_POST[kota]',
										 '$_POST[jasa]',
										 '$_POST[biaya]',
										 '$_SESSION[namauser]')");
  header('location:../../media.php?module='.$module);
}

// Update Ongkos Kirim
elseif ($module=='ongkoskirim' AND $act=='update'){
   mysql_query("UPDATE ongkos_kirim SET  id_kota  ='$_POST[kota]',
                                         id_jasa  ='$_POST[jasa]',
                                         biaya    ='$_POST[biaya]' 
                                  WHERE id_ongkir = '$_POST[id]'");
  header('location:../../media.php?module='.$module);
}
}
?>
