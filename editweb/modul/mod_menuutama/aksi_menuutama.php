<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
 
  echo "<link href='../../css/zalstyle.css' rel='stylesheet' type='text/css'>
  <link rel='shortcut icon' href='../../favicon.png' />
  
  <body class='special-page'>
  <div id='container'>
  <section id='error-number'>
  <img src='../../img/lock.png'>
  <h1>MODUL TIDAK DAPAT DIAKSES</h1>
  <p><span class style=\"font-size:14px; color:#ccc;\">Untuk mengakses modul, Anda harus login dahulu!</p></span><br/>
  </section>
  <section id='error-text'>
  <p><a class='button' href='../../index.php'> <b>LOGIN DI SINI</b> </a></p>
  </section>
  </div>";}
  
else{
include "../../../config/koneksi.php";
include "../../../config/fungsi_seo.php";

$module=$_GET[module];
$act=$_GET[act];

// Input menu utama
if ($module=='menuutama' AND $act=='input'){
  mysql_query("INSERT INTO mainmenu(nama_menu,
  username,link, urutan) VALUES('$_POST[nama_menu]', '$_SESSION[namauser]',
  '$_POST[link]', '$urutan')");
  header('location:../../media.php?module='.$module);
}

// Update menu utama
elseif ($module=='menuutama' AND $act=='update'){
  mysql_query("UPDATE mainmenu SET nama_menu='$_POST[nama_menu]', link='$_POST[link]', urutan='$_POST[urutan]', aktif='$_POST[aktif]' 
               WHERE id_main = '$_POST[id]'");
  header('location:../../media.php?module='.$module);
}

// Update id order posup
elseif ($module=='menuutama' AND $act=='posup'){
	$id=abs((int)$_GET['id']);
	$urutan=abs((int)$_GET['urutan']);
	$edit_order=$urutan-1;
	mysql_query("UPDATE mainmenu SET urutan='$edit_order' WHERE id_main=$id")or die(mysql_error());
	mysql_query("UPDATE mainmenu SET urutan='$urutan' WHERE id_main!=$id AND urutan=$edit_order")or die(mysql_error());
	header('location:../../media.php?module='.$module);
}

// Update id order posup
elseif ($module=='menuutama' AND $act=='posdo'){
	$id=abs((int)$_GET['id']);
	$urutan=abs((int)$_GET['urutan']);
	$edit_order=$urutan+1;
	mysql_query("UPDATE mainmenu SET urutan='$edit_order' WHERE id_main=$id")or die(mysql_error());
	mysql_query("UPDATE mainmenu SET urutan='$urutan' WHERE id_main!=$id AND urutan=$edit_order")or die(mysql_error());
	header('location:../../media.php?module='.$module);
}
}
?>
