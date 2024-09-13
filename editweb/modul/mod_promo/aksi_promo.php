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
include "../../../config/fungsi_seo.php";

$module=$_GET[module];
$act=$_GET[act];

// Hapus promo
if ($module=='promo' AND $act=='hapus'){
  $data=mysql_fetch_array(mysql_query("SELECT gambar FROM promo WHERE id_promo='$_GET[id]'"));
  if ($data[gambar]!=''){
     mysql_query("DELETE FROM promo WHERE id_promo='$_GET[id]'");
     unlink("../../../aw_banner/$_GET[namafile]");   
     unlink("../../../aw_banner/small_$_GET[namafile]");   
  }
  else{
     mysql_query("DELETE FROM promo WHERE id_promo='$_GET[id]'");
  }
  header('location:../../media.php?module='.$module);
}


// Input promo
elseif ($module=='promo' AND $act=='input'){
  $lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file      = $_FILES['fupload']['name'];
  $acak           = rand(1,99);
  $nama_file_unik = $acak.$nama_file; 

  $judul_seo      = seo_title($_POST[judul]);

  // Apabila ada gambar yang diupload
  if (!empty($lokasi_file)){
    UploadBanner($nama_file_unik);

   mysql_query("INSERT INTO promo(judul,
								   judul_seo,
								   url,
                                   tgl_posting,
								   gambar,
								   username) 
							VALUES('$_POST[judul]',
								   '$judul_seo', 
								   '$_POST[url]',
                                   '$tgl_sekarang',
								   '$nama_file_unik',
								   '$_SESSION[namauser]')");
  header('location:../../media.php?module='.$module);
  }
  else{
   mysql_query("INSERT INTO promo(judul,
								   judul_seo,
								   url,
								   tgl_posting,
								   username) 
							VALUES('$_POST[judul]',
								   '$judul_seo', 
								   '$_POST[url]',
                                   '$tgl_sekarang',
								   '$_SESSION[namauser]')");
  header('location:../../media.php?module='.$module);
  }
}
// Update promo
elseif ($module=='promo' AND $act=='update'){
  $lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file      = $_FILES['fupload']['name'];
  $acak           = rand(1,99);
  $nama_file_unik = $acak.$nama_file; 
  
  $judul_seo      = seo_title($_POST[judul]);

  // Apabila gambar tidak diganti
  if (empty($lokasi_file)){
    mysql_query("UPDATE promo SET judul       = '$_POST[judul]',
                                   judul_seo   = '$judul_seo', 
                                   url  = '$_POST[url]'  
                             WHERE id_promo   = '$_POST[id]'");
  header('location:../../media.php?module='.$module);
  }
  else{
    $data_gambar = mysql_query("SELECT gambar FROM promo WHERE id_promo='$_POST[id]'");
	$r    	= mysql_fetch_array($data_gambar);
	@unlink('../../../aw_banner/'.$r['gambar']);
	@unlink('../../../aw_banner/'.'small_'.$r['gambar']);
    UploadBanner($nama_file_unik ,'../../../aw_banner/');
    mysql_query("UPDATE promo SET judul       = '$_POST[judul]',
                                   judul_seo   = '$judul_seo', 
                                   url  = '$_POST[url]',
                                   gambar      = '$nama_file_unik'   
                             WHERE id_promo   = '$_POST[id]'");
    header('location:../../media.php?module='.$module);
  }
}
}
?>
