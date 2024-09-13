<?php

// fungsi untuk mendapatkan isi keranjang belanja
function isi_keranjang(){
    $tanggal = date("Ymd"); // Mendapatkan tanggal sekarang
	$kemarin = date('Y-m-d', mktime(0,0,0, date('m'), date('d') - 1, date('Y')));
	$isikeranjang = array();
	$sql = mysql_query("SELECT * FROM orders_temp WHERE tgl_order_temp < '$kemarin'");
	
	while ($r=mysql_fetch_array($sql)) {
		$isikeranjang[] = $r;
	}
	return $isikeranjang;
}

// cek ada order hari ini
$m=mysql_query("SELECT * FROM orders WHERE tgl_order < '$kemarin' AND status_order='Baru'");
if(mysql_num_rows($m) == 0){
 // panggil fungsi isi_keranjang dan hitung jumlah produk yang dipesan
$isikeranjang = isi_keranjang();
$jml          = count($isikeranjang);

// mengembalikan stok barang seperti semula
for ($i = 0; $i < $jml; $i++) {
	mysql_query("UPDATE produk SET stok = stok + {$isikeranjang[$i]['jumlah']}
						    WHERE id_produk = {$isikeranjang[$i]['id_produk']}");
}
 
}

?>