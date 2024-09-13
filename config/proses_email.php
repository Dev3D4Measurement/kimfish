<?php
session_start();
error_reporting(0);
include "koneksi.php";
include "library.php";

$nama = htmlentities(htmlspecialchars($_POST[nama]), ENT_QUOTES);
$email = htmlentities(htmlspecialchars($_POST[email]), ENT_QUOTES);
$subjek = htmlentities(htmlspecialchars($_POST[subjek]), ENT_QUOTES);
$pesan = htmlentities(htmlspecialchars($_POST[pesan]), ENT_QUOTES);

$iden=mysql_fetch_array(mysql_query("SELECT * FROM identitas"));

if((int)$_POST['captcha'] != $_SESSION['expect'])
$err[]='The captcha code is wrong!';


if(count($err))
{
if($_POST['ajax'])
{
echo '-1';
}

else if($_SERVER['HTTP_REFERER'])
{
$_SESSION['errStr'] = implode('<br />',$err);
$_SESSION['post']=$_POST;

header('Location: '.$_SERVER['HTTP_REFERER']);
}

exit;
}
  mysql_query("INSERT INTO hubungi(nama,
                                   email,
                                   subjek,
                                   pesan,
								   jam,
                                   tanggal) 
                        VALUES('$nama',
                               '$email',
                               '$subjek',
                               '$pesan',
							   '$jam_sekarang',
                               '$tgl_sekarang')");


//code untuk kirim email
$kepada = "$iden[email]"; 
$judul = "Ada Pesan di $iden[nama_website]";
$pesan = "Baru saja ada yang kirim pesan di $iden[nama_website]\n"; 
$pesan .= "kunjungi halaman administrator di $iden[url]"; 
mail($kepada,$judul,$pesan,"From: $iden[email]\n Content-type:text/html\r\n");


?>