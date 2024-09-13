 <?php
include "../config/koneksi.php";
$jumHub=mysql_num_rows(mysql_query("SELECT * FROM orders WHERE status_order='Baru'"));
echo "<span class='badge grey'><b>$jumHub</b></span>";
?>