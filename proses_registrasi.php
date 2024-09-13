<?php
 include "config/koneksi.php";
	$kl=mysql_query("insert into login values('','$_POST[nama]','$_POST[nohp]','$_POST[alamat]','$_POST[username]','$_POST[pass]')");
	echo"<script>alert('Data Sukses Tersimpan, Silahkan Login');window.location.href='login.html'</script>";
?>
