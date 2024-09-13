<?php
	if (($_SESSION[namauser] != '') AND ($_SESSION[leveluser] == 'kustomer')){
	$sql=mysql_query("SELECT * FROM kustomer WHERE id_kustomer='$_SESSION[namauser]'");
	$r=mysql_fetch_array($sql);
	echo"<div class='akun'><p>Selamat Datang, <b>$r[nama_lengkap]</b></p></div>
	     <ul class='s_list_1 clearfix'>
	     <li><a href='media.php?module=profil'>Akun Anda</a></li>
		 <li><a href='lihat-order.html'>Order Anda</a></li>
		 <li><a href='media.php?module=tampilorder'>Konfirmasi Order</a></li>
		 <li><a href='logout.php'>Logout</a></li>
         </ul>";
	}
	else{
	echo"<p><SCRIPT language=JavaScript src='js/almanak.js'></SCRIPT> 
          <span class='style1'></span> <SCRIPT language=JavaScript>var d = new Date();
var h = d.getHours();
}}}</SCRIPT></p>
        <ul class='s_list_1 clearfix'>
          <li><a id='various1' href='#inline1'>Login Anggota</a></li>
          <li><a href='daftar.html'>Daftar Anggota</a></li>
		  <li><a href='lupa-password.html'>Lupa Password</a></li>
        </ul>";
	}
	
	
?>
