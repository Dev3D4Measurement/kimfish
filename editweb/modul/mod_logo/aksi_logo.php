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
include "../../../config/library.php";
include "../../../config/fungsi_thumb.php";

$module=$_GET['module'];
$act=$_GET['act'];

// Update logo
if ($module=='logo' AND $act=='update'){
  $lokasi_file = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file   = $_FILES['fupload']['name'];

  // Apabila gambar tidak diganti
  if (empty($lokasi_file)){
   mysql_query("UPDATE logo SET  url       = '$_POST[url]'
                             WHERE id_logo = '$_POST[id]'");
   header('location:../../media.php?module='.$module);
    }
    else{
    $data_gambar = mysql_query("SELECT gambar FROM logo WHERE id_logo='$_POST[id]'");
	$r    	= mysql_fetch_array($data_gambar);
	@unlink('../../../aw_logo/'.$r['gambar']);
    UploadLogo($nama_file ,'../../../aw_logo/');
    mysql_query("UPDATE logo SET url       = '$_POST[url]',
                                 gambar    = '$nama_file' 
                             WHERE id_logo = '$_POST[id]'");
   header('location:../../media.php?module='.$module);
   }
  }
}

?>
