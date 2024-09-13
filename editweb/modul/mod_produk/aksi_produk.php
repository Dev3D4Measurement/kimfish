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

// Hapus produk
if ($module=='produk' AND $act=='hapus'){
  $data=mysql_fetch_array(mysql_query("SELECT gambar FROM produk WHERE id_produk='$_GET[id]'"));
  if ($data[gambar]!=''){
     mysql_query("DELETE FROM produk WHERE id_produk='$_GET[id]'");
     unlink("../../../aw_produk/$_GET[namafile]");   
     unlink("../../../aw_produk/small_$_GET[namafile]");   
  }
  else{
     mysql_query("DELETE FROM produk WHERE id_produk='$_GET[id]'");
  }
  header('location:../../media.php?module='.$module);
}


// Input produk
elseif ($module=='produk' AND $act=='input'){
  $lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file      = $_FILES['fupload']['name'];
  $acak           = rand(1,99);
  $nama_file_unik = $acak.$nama_file; 

  $produk_seo      = seo_title($_POST[nama_produk]);

  // Apabila ada gambar yang diupload
  if (!empty($lokasi_file)){
    UploadImage($nama_file_unik);

    mysql_query("INSERT INTO produk(nama_produk,
                                    id_kategori,
                                    produk_seo,
									deskripsi,
									berat,
									harga,
									stok,
									tgl_masuk,
									discount,
									terbaru,
									terlaris,
									potongan,
                                    gambar,
									username) 
                            VALUES('$_POST[nama_produk]',
							       '$_POST[kategori]',
                                   '$produk_seo',
								   '$_POST[deskripsi]',
								   '$_POST[berat]',
								   '$_POST[harga]',
								   '$_POST[stok]',
								   '$tgl_sekarang',
								   '$_POST[discount]',
								   '$_POST[terbaru]',
								   '$_POST[terlaris]',
								   '$_POST[potongan]',
                                   '$nama_file_unik',
								   '$_SESSION[namauser]')");
  header('location:../../media.php?module='.$module);
  }
  else{
    mysql_query("INSERT INTO produk(nama_produk,
                                    id_kategori,
                                    produk_seo,
									deskripsi,
									berat,
									harga,
									stok,
									tgl_masuk,
									discount,
									terbaru,
									terlaris,
									potongan,
									username) 
                            VALUES('$_POST[nama_produk]',
							       '$_POST[kategori]',
                                   '$produk_seo',
								   '$_POST[deskripsi]',
								   '$_POST[berat]',
								   '$_POST[harga]',
								   '$_POST[stok]',
								   '$tgl_sekarang',
								   '$_POST[discount]',
								   '$_POST[terbaru]',
								   '$_POST[terlaris]',
								   '$_POST[potongan]',
								   '$_SESSION[namauser]')");
  header('location:../../media.php?module='.$module);
  }
}

// Update produk
elseif ($module=='produk' AND $act=='update'){
  $lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file      = $_FILES['fupload']['name'];
  $acak           = rand(1,99);
  $nama_file_unik = $acak.$nama_file; 

  $produk_seo      = seo_title($_POST[nama_produk]);

  // Apabila gambar tidak diganti
  if (empty($lokasi_file)){
    mysql_query("UPDATE produk SET nama_produk = '$_POST[nama_produk]',
                                   produk_seo  = '$produk_seo', 
                                   id_kategori = '$_POST[kategori]',
								   berat       = '$_POST[berat]',
                                   harga       = '$_POST[harga]',
                                   stok        = '$_POST[stok]',
                                   deskripsi   = '$_POST[deskripsi]',
								   discount    = '$_POST[discount]',
								   terbaru     = '$_POST[terbaru]',
								   terlaris    = '$_POST[terlaris]',
								   potongan    = '$_POST[potongan]'
                             WHERE id_produk   = '$_POST[id]'");
  header('location:../../media.php?module='.$module);
  }
  else{
    $data_gambar = mysql_query("SELECT gambar FROM produk WHERE id_produk='$_POST[id]'");
	$r    	= mysql_fetch_array($data_gambar);
	@unlink('../../../aw_produk/'.$r['gambar']);
	@unlink('../../../aw_produk/'.'small_'.$r['gambar']);
    UploadImage($nama_file_unik ,'../../../aw_produk/');
    mysql_query("UPDATE produk SET nama_produk = '$_POST[nama_produk]',
                                    produk_seo  = '$produk_seo', 
                                    id_kategori = '$_POST[kategori]',
                                    berat       = '$_POST[berat]',
								    harga       = '$_POST[harga]',
                                    stok        = '$_POST[stok]',
                                    deskripsi   = '$_POST[deskripsi]',
                                    gambar      = '$nama_file_unik',
								    discount    = '$_POST[discount]',
								    terbaru     = '$_POST[terbaru]',
								    terlaris    = '$_POST[terlaris]',
								    potongan    = '$_POST[potongan]' 
                              WHERE id_produk   = '$_POST[id]'");
    header('location:../../media.php?module='.$module);
  }
}
}
?>
