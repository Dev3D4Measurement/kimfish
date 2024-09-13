<?php
include "../config/koneksi.php";

$sql=mysql_query("select * from modul where status='user' and aktif='Y' order by urutan"); 
while ($m=mysql_fetch_array($sql)){ 
	$cek=umenu_akses("$m[link]",$_SESSION[sessid]);
	if($cek==1 OR $_SESSION[leveluser]=='admin'){ 
		echo "<li><a href='$m[link]'><img src='../icon/$m[gambar]'> $m[nama_modul]</a></li>";
	}
}
?>
