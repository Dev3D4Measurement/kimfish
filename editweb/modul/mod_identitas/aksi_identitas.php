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
include "../../../config/fungsi_thumb.php";

$module=$_GET[module];
$act=$_GET[act];

// Update identitas
if ($module=='identitas' AND $act=='update'){
  $lokasi_file = $_FILES['fupload']['tmp_name'];
  $nama_file   = $_FILES['fupload']['name'];

  // Apabila ada gambar yang diupload
  if (!empty($lokasi_file)){
    UploadLogo($nama_file);
    mysql_query("UPDATE identitas SET nama_website   = '$_POST[nama_website]',
                                      meta_deskripsi = '$_POST[meta_deskripsi]',
                                      meta_keyword   = '$_POST[meta_keyword]',
									  email          = '$_POST[email]',
									  tlp            = '$_POST[tlp]',
									  alamat         = '$_POST[alamat]',
									  url            = '$_POST[url]',
									  facebook       = '$_POST[facebook]',
                                      favicon        = '$nama_file'    
                                WHERE id_identitas   = '$_POST[id]'");
  }
  else{
  
    mysql_query("UPDATE identitas SET nama_website   = '$_POST[nama_website]',
                                      meta_deskripsi = '$_POST[meta_deskripsi]',
                                      meta_keyword   = '$_POST[meta_keyword]',
									  meta_keyword   = '$_POST[meta_keyword]',
									  email          = '$_POST[email]',
									  tlp            = '$_POST[tlp]',
									  alamat         = '$_POST[alamat]',
									  url            = '$_POST[url]',
									  facebook       = '$_POST[facebook]'
                                WHERE id_identitas   = '$_POST[id]'");
  }
  header('location:../../media.php?module='.$module);
}
}
?>
