 <?php
include "../config/koneksi.php";
$jumHub=mysql_num_rows(mysql_query("SELECT * FROM konfirmasi WHERE dibaca='N'"));
echo "<span class='badge grey'><b>$jumHub</b></span>";
?>