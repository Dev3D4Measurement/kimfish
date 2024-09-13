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

// Input templates
  if ($module=='templates' AND $act=='input'){
  $lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file      = $_FILES['fupload']['name'];
  $acak           = rand(1,99);
  $nama_file_unik = $acak.$nama_file; 

  // Apabila ada gambar yang diupload
  if (!empty($lokasi_file)){
    UploadTemplates($nama_file_unik);

   mysql_query("INSERT INTO templates(judul,
								      pembuat,
									  folder,
									  username,
								      gambar) 
							  VALUES('$_POST[judul]',
								     '$_POST[pembuat]',
									 '$_SESSION[namauser]',
								     '$_POST[folder]',
								     '$nama_file_unik')");
  header('location:../../media.php?module='.$module);
  }
  else{
   mysql_query("INSERT INTO templates(judul,
								      pembuat,
									  folder) 
							  VALUES('$_POST[judul]',
								     '$_POST[pembuat]',
								     '$_POST[folder]')");
  header('location:../../media.php?module='.$module);
  }
}
// Update templates
elseif ($module=='templates' AND $act=='update'){
  $lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file      = $_FILES['fupload']['name'];
  $acak           = rand(1,99);
  $nama_file_unik = $acak.$nama_file; 
  
  // Apabila gambar tidak diganti
  if (empty($lokasi_file)){
    mysql_query("UPDATE templates SET judul  = '$_POST[judul]',
                                      folder = '$_POST[folder]' 
                        WHERE id_templates   = '$_POST[id]'");
  header('location:../../media.php?module='.$module);
  }
  else{
    $data_gambar = mysql_query("SELECT gambar FROM templates WHERE id_templates='$_POST[id]'");
	$r    	= mysql_fetch_array($data_gambar);
	@unlink('../../../aw_templates/'.$r['gambar']);
	@unlink('../../../aw_templates/'.'small_'.$r['gambar']);
    UploadTemplates($nama_file_unik ,'../../../aw_templates/');
    mysql_query("UPDATE templates SET judul  = '$_POST[judul]',
                                      folder = '$_POST[folder]',
                                   gambar    = '$nama_file_unik'   
                             WHERE id_templates   = '$_POST[id]'");
    header('location:../../media.php?module='.$module);
  }
}
// Aktifkan templates
elseif ($module=='templates' AND $act=='aktifkan'){
  $query1=mysql_query("UPDATE templates SET aktif='Y' WHERE id_templates='$_GET[id]'");
  $query2=mysql_query("UPDATE templates SET aktif='N' WHERE id_templates!='$_GET[id]'");
  header('location:../../media.php?module='.$module);
  }
}
?>
