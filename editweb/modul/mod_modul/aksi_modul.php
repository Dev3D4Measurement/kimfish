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

// Hapus modul
if ($module=='modul' AND $act=='hapus'){
  mysql_query("DELETE FROM modul WHERE id_modul='$_GET[id]'");
  header('location:../../media.php?module='.$module);
}


// Input modul
elseif ($module=='modul' AND $act=='input'){

  // Cari angka urutan terakhir
  $u=mysql_query("SELECT urutan FROM modul ORDER by urutan DESC");
  $d=mysql_fetch_array($u);
  $urutan=$d[urutan]+1;
  

    mysql_query("INSERT INTO modul(nama_modul,
                                   link,
                                   publish,
								   username,
                                   aktif,
								   status,
                                   urutan) 
	                        VALUES('$_POST[nama_modul]',
                                   '$_POST[link]',
                                   '$_POST[publish]',
								   '$_SESSION[namauser]',
                                   '$_POST[aktif]',
								   '$_POST[status]',
                                   '$urutan')");
  header('location:../../media.php?module='.$module);
  
}

// Update modul
elseif ($module=='modul' AND $act=='update'){
    mysql_query("UPDATE modul SET nama_modul = '$_POST[nama_modul]',
                                link       = '$_POST[link]',
                                publish    = '$_POST[publish]',
                                aktif      = '$_POST[aktif]',
								status     = '$_POST[status]',
                                urutan     = '$_POST[urutan]'  
                          WHERE id_modul   = '$_POST[id]'");
  header('location:../../media.php?module='.$module);

}
}
?>
