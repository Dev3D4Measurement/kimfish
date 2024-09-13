 <?php
include "../config/koneksi.php";
$a=mysql_fetch_array(mysql_query("SELECT * FROM users WHERE username='$_SESSION[namauser]'"));
echo "<img class='img-left framed' src='../foto_user/small_$a[foto]'' alt='$a[username]'>
      <h3><SCRIPT language=JavaScript>var d = new Date();
var h = d.getHours();
if (h < 11) { document.write('Selamat pagi,'); }
else { if (h < 15) { document.write('Selamat siang,'); }
else { if (h < 19) { document.write('Selamat sore,'); }
else { if (h <= 23) { document.write('Selamat malam,'); }
}}}</SCRIPT></h3> 
      <h2><div class=user-button><a href='?module=user&act=edituser&id=$a[id_session]'>$a[nama_lengkap]</a>&nbsp;<span class=arrow-link-down>
      </span>
      </a>
      </h2>";
?>