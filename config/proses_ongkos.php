<?php
include "koneksi.php";

$jasa = $_GET["jasa"];
$sql = mysql_query("SELECT * FROM ongkos_kirim WHERE id_ongkir='$jasa'");
while($r = mysql_fetch_array($sql)){
    echo "Rp. $r[biaya]";
}
?>
