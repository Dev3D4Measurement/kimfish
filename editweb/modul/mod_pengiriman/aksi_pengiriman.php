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

$module=$_GET['module'];
$act=$_GET['act'];

// Hapus pengiriman
if ($module=='pengiriman' AND $act=='hapus'){
  $data=mysql_fetch_array(mysql_query("SELECT gambar FROM jasa_kirim WHERE id_jasa='$_GET[id]'"));
  if ($data[gambar]!=''){
     mysql_query("DELETE FROM jasa_kirim WHERE id_jasa='$_GET[id]'");
      unlink("../../../aw_banner/$_GET[namafile]");   
     unlink("../../../aw_banner/small_$_GET[namafile]"); 
  }
  else{
     mysql_query("DELETE FROM jasa_kirim WHERE id_jasa='$_GET[id]'");
  }
  header('location:../../media.php?module='.$module);
}

// Input pengiriman
elseif ($module=='pengiriman' AND $act=='input'){
  $lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file      = $_FILES['fupload']['name'];
  $acak           = rand(1,99);
  $nama_file_unik = $acak.$nama_file; 


  // Apabila ada gambar yang diupload
  if (!empty($lokasi_file)){
    UploadBanner($nama_file_unik);
    
    mysql_query("INSERT INTO jasa_kirim(nama_jasa,
										link,
	                                    gambar,
										 username) 
                            VALUES('$_POST[nama_jasa]',
							       '$_POST[link]',
							       '$nama_file_unik',
							       '$_SESSION[namauser]')");
  header('location:../../media.php?module='.$module);
  }
  else{
   mysql_query("INSERT INTO jasa_kirim(username,link, nama_jasa) 
                            VALUES('$_SESSION[namauser]','$_POST[link]','$_POST[nama_jasa]')");
  header('location:../../media.php?module='.$module);
  }
}

// Update pengiriman
elseif ($module=='pengiriman' AND $act=='update'){
  $lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file      = $_FILES['fupload']['name'];
  $acak           = rand(1,99);
  $nama_file_unik = $acak.$nama_file; 


  // Apabila gambar tidak diganti
  if (empty($lokasi_file)){
   mysql_query("UPDATE jasa_kirim SET nama_jasa = '$_POST[nama_jasa]',
                                      link      = '$_POST[link]' 
                                  WHERE id_jasa = '$_POST[id]'");
  header('location:../../media.php?module='.$module);
  }
  else{
    $data_gambar = mysql_query("SELECT gambar FROM jasa_kirim 
	                                          WHERE id_jasa='$_POST[id]'");
	$r    	= mysql_fetch_array($data_gambar);
	@unlink('../../../aw_banner/'.$r['gambar']);
	@unlink('../../../aw_banner/'.'small_'.$r['gambar']);
    UploadBanner($nama_file_unik ,'../../../aw_banner/');
    mysql_query("UPDATE jasa_kirim SET nama_jasa   = '$_POST[nama_jasa]',
	                                        link   = '$_POST[link]',
                                          gambar   = '$nama_file_unik'
                                     WHERE id_jasa = '$_POST[id]'");
  header('location:../../media.php?module='.$module);
}
}
}
?>