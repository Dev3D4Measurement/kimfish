<?php
session_start();

error_reporting(0);
include "koneksi.php";
include "library.php";

$namalengkap = htmlentities(htmlspecialchars($_POST[namalengkap]), ENT_QUOTES);
$email = htmlentities(htmlspecialchars($_POST[email]), ENT_QUOTES);
$noorder = htmlentities(htmlspecialchars($_POST[noorder]), ENT_QUOTES);
$pesan = htmlentities(htmlspecialchars($_POST[pesan]), ENT_QUOTES);
$tglpembayaran = htmlentities(htmlspecialchars($_POST[tglpembayaran]), ENT_QUOTES);
$id_bank = htmlentities(htmlspecialchars($_POST[bank]), ENT_QUOTES);
$jmlhpembayaran = htmlentities(htmlspecialchars($_POST[jmlhpembayaran]), ENT_QUOTES);
$namarekening = htmlentities(htmlspecialchars($_POST[namarekening]), ENT_QUOTES);
$tlp = htmlentities(htmlspecialchars($_POST[tlp]), ENT_QUOTES);
$norekening = htmlentities(htmlspecialchars($_POST[norekening]), ENT_QUOTES);

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
  
  mysql_query("INSERT INTO konfirmasi(namalengkap,
                                   email,
                                   noorder,
                                   pesan,
								   jmlhpembayaran,
								   jam,
								   id_bank,
								   namarekening,
								   norekening,
								   tlp,
                                   tglpembayaran) 
                        VALUES('$namalengkap',
                               '$email',
                               '$noorder',
                               '$pesan',
							   '$jmlhpembayaran',
							   '$jam_sekarang',
							   '$id_bank',
							   '$namarekening',
							   '$norekening',
							   '$tlp',
                               '$tgl_sekarang')");

//code untuk kirim email
$kepada = "$iden[email]"; 
$judul = "Ada Pesan di $iden[nama_website]";
$pesan = "Baru saja ada yang konfirmasi pembayaran di $iden[nama_website]\n"; 
$pesan .= "kunjungi halaman administrator di $iden[url]"; 
mail($kepada,$judul,$pesan,"From: $iden[email]\n Content-type:text/html\r\n");

?>