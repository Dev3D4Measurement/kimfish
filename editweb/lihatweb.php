 <?php
include "../config/koneksi.php";
$iden=mysql_fetch_array(mysql_query("SELECT url FROM identitas"));
  echo"<a href='$iden[url]' target='_blank' class='button'>Lihat Web</a> ";
?>