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

$module=$_GET['module'];
$act=$_GET['act'];

// Hapus bank
if ($module=='bank' AND $act=='hapus'){
  $data=mysql_fetch_array(mysql_query("SELECT gambar FROM mod_bank WHERE id_bank='$_GET[id]'"));
  if ($data[gambar]!=''){
     mysql_query("DELETE FROM mod_bank WHERE id_bank='$_GET[id]'");
      unlink("../../../aw_banner/$_GET[namafile]");   
     unlink("../../../aw_banner/small_$_GET[namafile]"); 
  }
  else{
     mysql_query("DELETE FROM mod_bank WHERE id_bank='$_GET[id]'");
  }
  header('location:../../media.php?module='.$module);
}

// Input bank
elseif ($module=='bank' AND $act=='input'){
  $lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file      = $_FILES['fupload']['name'];
  $acak           = rand(1,99);
  $nama_file_unik = $acak.$nama_file; 


  // Apabila ada gambar yang diupload
  if (!empty($lokasi_file)){
    UploadBanner($nama_file_unik);
    
    mysql_query("INSERT INTO mod_bank(nama_bank,
	                                  no_rekening,
                                      pemilik,
	                                  gambar,
									  username) 
                              VALUES('$_POST[nama_bank]',
							         '$_POST[no_rekening]',
                                     '$_POST[pemilik]',
							         '$nama_file_unik',
							         '$_SESSION[namauser]')");
  header('location:../../media.php?module='.$module);
  }
  else{
  mysql_query("INSERT INTO mod_bank(nama_bank,
                                    no_rekening,
                                    pemilik,
									username) 
                            VALUES('$_POST[nama_bank]',
                                   '$_POST[no_rekening]',
                                   '$_POST[pemilik]',
								   '$_SESSION[namauser]')");
  header('location:../../media.php?module='.$module);
  }
}

// Update bank
elseif ($module=='bank' AND $act=='update'){
  $lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file      = $_FILES['fupload']['name'];
  $acak           = rand(1,99);
  $nama_file_unik = $acak.$nama_file; 


  // Apabila gambar tidak diganti
  if (empty($lokasi_file)){
    mysql_query("UPDATE mod_bank SET nama_bank    = '$_POST[nama_bank]',
                                     no_rekening  = '$_POST[no_rekening]',
                                      pemilik     = '$_POST[pemilik]'                                   
                                WHERE id_bank     = '$_POST[id]'");
  header('location:../../media.php?module='.$module);
  }
  else{
    $data_gambar = mysql_query("SELECT gambar FROM mod_bank WHERE id_bank='$_POST[id]'");
	$r    	= mysql_fetch_array($data_gambar);
	@unlink('../../../aw_banner/'.$r['gambar']);
	@unlink('../../../aw_banner/'.'small_'.$r['gambar']);
    UploadBanner($nama_file_unik ,'../../../aw_banner/');
   mysql_query("UPDATE mod_bank SET nama_bank   = '$_POST[nama_bank]',
                                    no_rekening  = '$_POST[no_rekening]',
                                    pemilik      = '$_POST[pemilik]',
                                    gambar       = '$nama_file_unik'
                              WHERE id_bank      = '$_POST[id]'");
  header('location:../../media.php?module='.$module);
}
}
}
?>