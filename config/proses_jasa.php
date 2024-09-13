<?php
include "koneksi.php";

$kota = $_GET["kota"];

$jasa = mysql_query("SELECT k.id_kota, j.id_jasa, j.nama_jasa jasa, o.biaya biaya, o.id_ongkir FROM 
                              kota k, ongkos_kirim o, jasa_kirim j 
                              WHERE k.id_kota=o.id_kota
                              AND j.id_jasa=o.id_jasa                             
                              AND k.id_kota='$kota' ");
echo "<option>- Pilih Jasa Pengiriman -</option>";
      while($j = mysql_fetch_array($jasa)){
echo "<option value=$j[id_ongkir]>$j[jasa]</option> \n";
}

?>
