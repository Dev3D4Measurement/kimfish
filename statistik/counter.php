<?
$countertabel=mysql_query("SELECT * FROM hitscounter");
$totalyangada=mysql_fetch_array($countertabel);
$totalyangada1=$totalyangada[hits]+1;
$updatecounter=mysql_query("UPDATE hitscounter SET hits = '$totalyangada1'");
$tampilkansekarang=mysql_query("SELECT * FROM hitscounter");
$tampilkansekarang1=mysql_fetch_array($tampilkansekarang);
echo "$tampilkansekarang1[hits]";
?>