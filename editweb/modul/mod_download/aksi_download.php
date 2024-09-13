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

// Hapus download
if ($module=='download' AND $act=='hapus'){
  $data=mysql_fetch_array(mysql_query("SELECT nama_file FROM download WHERE id_download='$_GET[id]'"));
  if ($data[nama_file]!=''){
     mysql_query("DELETE FROM download WHERE id_download='$_GET[id]'");
     unlink("../../../file/$_GET[namafile]");     
  }
  else{
     mysql_query("DELETE FROM download WHERE id_download='$_GET[id]'");
  }
  header('location:../../media.php?module='.$module);
}


// Hapus gambar download lama
if ($module=='download' AND $act=='delgambar'){
  $data=mysql_fetch_array(mysql_query("SELECT nama_file FROM download WHERE id_download='$_GET[id]'"));
  if ($data[nama_file]!=''){
  unlink("../../../file/$_GET[namafile]");   
}
else{
  $r=mysql_fetch_array(mysql_query("SELECT * FROM download ORDER BY id_download DESC"));
  echo "<script>window.alert('Tidak gambar yang dihapus!');
        window.location=('../../media.php?module=download&act=editdownload&id=$r[id_download]')</script>";
  }
  $r=mysql_fetch_array(mysql_query("SELECT * FROM download ORDER BY id_download DESC"));
  echo "<script>window.alert('Hapus gambar sukses!');
        window.location=('../../media.php?module=download&act=editdownload&id=$r[id_download]')</script>";
}

// Input download
elseif ($module=='download' AND $act=='input'){
  $lokasi_file = $_FILES['fupload']['tmp_name'];
  $nama_file   = $_FILES['fupload']['name'];

  // Apabila ada gambar yang diupload
  if (!empty($lokasi_file)){
  
  $file_extension = strtolower(substr(strrchr($nama_file,"."),1));

  switch($file_extension){
    case "pdf": $ctype="application/pdf"; break;
    case "exe": $ctype="application/octet-stream"; break;
    case "zip": $ctype="application/zip"; break;
    case "rar": $ctype="application/rar"; break;
    case "doc": $ctype="application/msword"; break;
    case "xls": $ctype="application/vnd.ms-excel"; break;
    case "ppt": $ctype="application/vnd.ms-powerpoint"; break;
    case "gif": $ctype="image/gif"; break;
    case "png": $ctype="image/png"; break;
    case "jpeg":
    case "jpg": $ctype="image/jpg"; break;
    default: $ctype="application/proses";
  }

  if ($file_extension=='php'){
   echo "<script>window.alert('Upload Gagal, Pastikan File yang di Upload tidak bertipe *.PHP');
        window.location=('../../media.php?module=download')</script>";
  }
  else{
    UploadFile($nama_file);
    mysql_query("INSERT INTO download(judul,
                                    nama_file,
									username,
                                    tgl_posting) 
                            VALUES('$_POST[judul]',
                                   '$nama_file',
								   '$_SESSION[namauser]',
                                   '$tgl_sekarang')");
  header('location:../../media.php?module='.$module);
  }
  }
  else{
    mysql_query("INSERT INTO download(judul,
	                                  username,
                                    tgl_posting) 
                            VALUES('$_POST[judul]',
							       '$_SESSION[namauser]',
                                   '$tgl_sekarang')");
  header('location:../../media.php?module='.$module);
  }
}

// Update donwload
elseif ($module=='download' AND $act=='update'){
  $lokasi_file = $_FILES['fupload']['tmp_name'];
  $nama_file   = $_FILES['fupload']['name'];

  // Apabila file tidak diganti
  if (empty($lokasi_file)){
    mysql_query("UPDATE download SET judul     = '$_POST[judul]'
                             WHERE id_download = '$_POST[id]'");
  header('location:../../media.php?module='.$module);
  }
  else{
  $file_extension = strtolower(substr(strrchr($nama_file,"."),1));

  switch($file_extension){
    case "pdf": $ctype="application/pdf"; break;
    case "exe": $ctype="application/octet-stream"; break;
    case "zip": $ctype="application/zip"; break;
    case "rar": $ctype="application/rar"; break;
    case "doc": $ctype="application/msword"; break;
    case "xls": $ctype="application/vnd.ms-excel"; break;
    case "ppt": $ctype="application/vnd.ms-powerpoint"; break;
    case "gif": $ctype="image/gif"; break;
    case "png": $ctype="image/png"; break;
    case "jpeg":
    case "jpg": $ctype="image/jpg"; break;
    default: $ctype="application/proses";
  }

  if ($file_extension=='php'){
   echo "<script>window.alert('Upload Gagal, Pastikan File yang di Upload tidak bertipe *.PHP');
        window.location=('../../media.php?module=download')</script>";
  }
  else{
    $data_gambar = mysql_query("SELECT nama_file FROM download WHERE id_download='$_POST[id]'");
	$r    	= mysql_fetch_array($data_gambar);
	@unlink('../../../file/'.$r['nama_file']);
    UploadFile($nama_file ,'../../../file/');
    mysql_query("UPDATE download SET judul     = '$_POST[judul]',
                                   nama_file    = '$nama_file'   
                             WHERE id_download = '$_POST[id]'");
  header('location:../../media.php?module='.$module);
  }
  }
}
}
?>
