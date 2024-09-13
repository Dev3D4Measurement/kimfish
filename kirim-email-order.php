<?php
include "config/authentication_kustomer.php";
include "config/koneksi.php";
include "config/fungsi_rupiah.php";

//fungsi kirim email pemberitahuan order
//dapatkan data order 
	$sql=mysql_query("SELECT * FROM orders WHERE id_kustomer='$_SESSION[namauser]' AND status_order='Baru' ORDER BY id_orders DESC LIMIT 1");
	$count=mysql_num_rows($sql);
	
	if ($count > 0 ){
		$r=mysql_fetch_array($sql);
		//tampil data kustomer
		$tampil=mysql_query("SELECT * FROM kustomer WHERE id_kustomer='$r[id_kustomer]'");
		$r2=mysql_fetch_array($tampil);
			
		$daftarproduk=mysql_query("SELECT * FROM orders_detail,produk 
											 WHERE orders_detail.id_produk=produk.id_produk 
											 AND id_orders='$r[id_orders]'");
		//Informasi Pengiriman
		if ($r[shipping] == 'akun'){
			$alamat		= $r2[alamat];
			$kodepos	= $r2[kode_pos];
			$propinsi	= $r2[propinsi];
			$kota		= $r2[kota];
		}
		else{
			$alamat		= $r[alamat_kirim];
			$kodepos	= $r[kode_pos_kirim];
			$propinsi	= $r[propinsi_kirim];
			$kota		= $r[kota_kirim];	
		}
			
		//Isi pesan bagian header								 
		$pesan="<br/>Terima kasih Tuan/Nona.  $r2[nama_lengkap] telah melakukan pemesanan online di $domain.com <br /><br />  
				Berikut data order anda :<br/>
				Username anda : $r[id_kustomer]<br/>
				No Order : $r[id_orders] <br/>
				Tanggal Order : $r[tgl_order]<br/>
				<hr />
				Barang dikirim ke Alamat : $alamat <br/>
				Kode Pos : $kodepos <br/>
				Propinsi : $propinsi <br/>
				Kota     : $kota <br/>
				<hr /><br />
				Produk yang anda pesan sebagai berikut: <br /><br />";
		
		while ($d=mysql_fetch_array($daftarproduk)){
		   $subtotal    = $d[harga] * $d[jumlah];
		   $total       = $total + $subtotal;
		   $subtotal_rp = format_rupiah($subtotal);    
		   $total_rp    = format_rupiah($total);    
		   $harga       = format_rupiah($d[harga]);
		  
			$pesan.="$d[jumlah] $d[nama_produk] -> Rp. $harga -> Subtotal: Rp. $subtotal_rp <br />";
		}
	
	//Menghitung Biaya Pengiriman
	$ongkos=mysql_fetch_array(mysql_query("SELECT ongkos_kirim FROM kota WHERE nama_kota='$kota'"));
	$ongkoskirim=$ongkos[ongkos_kirim];

	$grandtotal    = $total + $ongkoskirim; 

	$ongkoskirim_rp = format_rupiah($ongkoskirim);
	$grandtotal_rp  = format_rupiah($grandtotal); 

	$pesan.="<br /><br />Total : Rp. $total_rp 
			 <br />Ongkos kirim: Rp. $ongkoskirim_rp
			 <br />Total Pembayaran : Rp. $grandtotal_rp 
			 <br /><br />
			 Silahkan lakukan pembayaran sebesar Total Pembayaran yang tercantum, serta konfirmasikan pembayaran anda.<br/>
			 Barang akan segera dikirim setelah melakukan komfirmasi pembayaran.<br/>
			 Apabila Anda tidak melakukan pembayaran dalam 3 hari, maka data order Anda akan terhapus (transaksi batal).
			 <br/>";

	$subjek="Pemesanan Online di $domain.com";

	// Kirim email dalam format HTML
	$dari = "From: ashyck_81@yahoo.com \n";
	$dari .= "Content-type: text/html \r\n";
	
	$kustomer = mysql_query("SELECT * FROM kustomer WHERE id_kustomer = '$r[id_kustomer]'");
	$rkustomer = mysql_fetch_array($kustomer);
	
	// Kirim email ke kustomer
	mail($rkustomer[email],$subjek,$pesan,$dari);

	// Kirim email ke pengelola toko online
	mail("ashyck_81@yahoo.com",$subjek,$pesan,$dari);
	
	/*
	//preview email
	echo "<p align=center><b>Isi Pesan</b></p>
		  Kepada : $rkustomer[email]<br/>
		  Dari : $dari <br/>
		  Subject : $subjek <br/>
		  Isi Pesan : <br/><br/>
		  $pesan"; */
	}
?>