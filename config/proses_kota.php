<?php
include "koneksi.php";

$propinsi = $_GET['propinsi'];
$kota = mysql_query("SELECT * FROM kota WHERE id_propinsi='$propinsi' ");
echo "<option>- Pilih Kota Tujuan -</option>";
      while($k = mysql_fetch_array($kota)){
echo "<option value=$k[id_kota]>$k[nama_kota]</option> \n";
}
?>
