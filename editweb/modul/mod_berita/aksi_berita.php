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

// Hapus berita
if ($module=='berita' AND $act=='hapus'){
  $data=mysql_fetch_array(mysql_query("SELECT gambar FROM berita WHERE id_berita='$_GET[id]'"));
  if ($data[gambar]!=''){
     mysql_query("DELETE FROM berita WHERE id_berita='$_GET[id]'");
     unlink("../../../aw_berita/$_GET[namafile]");   
     unlink("../../../aw_berita/small_$_GET[namafile]");   
  }
  else{
     mysql_query("DELETE FROM berita WHERE id_berita='$_GET[id]'");
  }
  header('location:../../media.php?module='.$module);
}


// Input berita
elseif ($module=='berita' AND $act=='input'){
  $lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file      = $_FILES['fupload']['name'];
  $acak           = rand(1,99);
  $nama_file_unik = $acak.$nama_file; 

  $judul_seo      = seo_title($_POST[judul]);

  // Apabila ada gambar yang diupload
  if (!empty($lokasi_file)){
    UploadBerita($nama_file_unik);

   mysql_query("INSERT INTO berita(judul,
								   judul_seo,
								   isi_berita,
								   jam,
                                   tanggal,
                                   hari,
								   gambar,
								   username) 
							VALUES('$_POST[judul]',
								   '$judul_seo', 
								   '$_POST[isi_berita]',
								   '$jam_sekarang',
                                   '$tgl_sekarang',
                                   '$hari_ini',
								   '$nama_file_unik',
								   '$_SESSION[namauser]')");
  header('location:../../media.php?module='.$module);
  }
  else{
   mysql_query("INSERT INTO berita(judul,
								   judul_seo,
								   isi_berita,
								   jam,
								   tanggal,
								   hari,
								   username) 
							VALUES('$_POST[judul]',
								   '$judul_seo', 
								   '$_POST[isi_berita]',
								   '$jam_sekarang',
                                   '$tgl_sekarang',
                                   '$hari_ini',
								   '$_SESSION[namauser]')");
  header('location:../../media.php?module='.$module);
  }
}
// Update berita
elseif ($module=='berita' AND $act=='update'){
  $lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file      = $_FILES['fupload']['name'];
  $acak           = rand(1,99);
  $nama_file_unik = $acak.$nama_file; 
  
  $judul_seo      = seo_title($_POST[judul]);

  // Apabila gambar tidak diganti
  if (empty($lokasi_file)){
    mysql_query("UPDATE berita SET judul       = '$_POST[judul]',
                                   judul_seo   = '$judul_seo', 
                                   isi_berita  = '$_POST[isi_berita]'  
                             WHERE id_berita   = '$_POST[id]'");
  header('location:../../media.php?module='.$module);
  }
  else{
    $data_gambar = mysql_query("SELECT gambar FROM berita WHERE id_berita='$_POST[id]'");
	$r    	= mysql_fetch_array($data_gambar);
	@unlink('../../../aw_berita/'.$r['gambar']);
	@unlink('../../../aw_berita/'.'small_'.$r['gambar']);
    UploadBerita($nama_file_unik ,'../../../aw_berita/');
    mysql_query("UPDATE berita SET judul       = '$_POST[judul]',
                                   judul_seo   = '$judul_seo', 
                                   isi_berita  = '$_POST[isi_berita]',
                                   gambar      = '$nama_file_unik'   
                             WHERE id_berita   = '$_POST[id]'");
    header('location:../../media.php?module='.$module);
  }
}
}
?>
