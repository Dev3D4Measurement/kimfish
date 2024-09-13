<?php
// Halaman simpantransaksi
if ($_GET[module]=='simpantransaksi'){

  $iden=mysql_fetch_array(mysql_query("SELECT * FROM identitas"));
  $rekening=mysql_fetch_array(mysql_query("SELECT * FROM mod_bank"));
  $logo=mysql_fetch_array(mysql_query("SELECT * FROM logo"));
//===========================================================================================================

echo "<div class='contener_panel'>
      <div class='content'>
	  <div id='maincontaner'>
      <div class='top_contener'>
      <div class='top_panel'>
	  
	   <div class='topnav'>";
	   require_once "item.php";
echo "</div>";
echo "<div class='navigation-inner'>
	  <div class='home-icon'>
	  <a href='$iden[url]'><img src='$f[folder]/images/home_icon.png' border='0'/></a>	       
	  </div>
      <div id='smoothmenu1' class='ddsmoothmenu'>
	  
      <ul>";
	  $main=mysql_query("SELECT * FROM mainmenu WHERE aktif='Y' ORDER BY urutan");
      while($r=mysql_fetch_array($main)){
echo "<li><a href='$r[link]'>$r[nama_menu]</a>";
      $sub=mysql_query("SELECT * FROM submenu, mainmenu  
                                 WHERE submenu.id_main=mainmenu.id_main 
                                 AND submenu.id_main=$r[id_main]");
      $jml=mysql_num_rows($sub);
      // apabila sub menu ditemukan
       if ($jml > 0){
echo "<ul>";
      while($w=mysql_fetch_array($sub)){
echo "<li><a href='$w[link_sub]'>$w[nama_sub]</a></li>";
	  }           
echo "</ul>";
		}
      }
	  
echo "</div>
	  <div class='form'>
      <form action='hasil-pencarian.html' enctype='multipart/form-data' method='POST'>
      <input type='text' value='cari produk' onFocus='if (this.value=='cari produk') {this.value='cari produk';}' 
      onBlur='if (this.value=='cari produk') {this.value='cari produk';}' name='kata' id='s' class='textbox'/>
      <input class='search_icon' type='image' src='$f[folder]/images/search-icon.png' alt=' ' />
      </form>
      </div>
   	  </div>
      </div>
      </div>
      </div>
	  <div class='left'>";
	   include "sidebar.php"; 

echo "</div>";
				
///////////////////////////////////////////////////////////////////////////////////////////////

echo "<div id='slider-wrapper'>
      <div id='slider' class='nivoSlider'>";
      $header=mysql_query("SELECT * FROM header INNER JOIN kategoriproduk 
	                               ON header.id_kategori=kategoriproduk.id_kategori");
	  $no=1;
	  while($h=mysql_fetch_array($header)){
echo "<a href='kategori-$h[id_kategori]-$h[kategori_seo].html'>
      <img src='aw_header/$h[gambar]' width='745' height='250' /></a>";
	  $no++;
	  }
echo "</div>
      </div>";   
	     
//===========================================================================================================		 


echo"<div class='featured'>";
	 $kar1=strstr($_POST[email], "@");
$kar2=strstr($_POST[email], ".");

if (empty($_POST[nama]) || empty($_POST[alamat]) || empty($_POST[telpon]) || empty($_POST[email]) || empty($_POST[jasa]) || empty($_POST[kode])){
  echo "<div class='valid'>Data yang Anda isikan belum lengkap<br />
  	    <a href='selesai-belanja.html'><b>Ulangi Lagi</b>
        </div>";
}
elseif (!ereg("[a-z|A-Z]","$_POST[nama]")){
  echo "<script> alert('Nama tidak boleh diisi dengan angka atau simbol');window.location='selesai-belanja.html'</script>";
}
elseif (strlen($kar1)==0 OR strlen($kar2)==0){
  echo "<script> alert('Alamat email Anda tidak valid, mungkin kurang tanda titik (.) atau tanda @.');window.location='selesai-belanja.html'</script>";
}
else{
// fungsi untuk mendapatkan isi keranjang belanja
function isi_keranjang(){
    $isikeranjang = array();
    $sid = session_id();
    $sql = mysql_query("SELECT * FROM orders_temp, produk
                                 WHERE orders_temp.id_produk=produk.id_produk
                                 AND id_session='$sid'");
   
    while ($r=mysql_fetch_array($sql)) {
        $isikeranjang[] = $r;
    }
    return $isikeranjang;
} 

$tgl_skrg = date("Ymd");
$jam_skrg = date("H:i:s");

if(!empty($_POST['kode'])){
if($_POST['kode']==$_SESSION['kode']){

function antiinjection($data){
  $filter_sql = mysql_real_escape_string(stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES))));
  return $filter_sql;
}

$nama   = antiinjection($_POST['nama']);
$alamat = antiinjection($_POST['alamat']);
$telpon = antiinjection($_POST['telpon']);

// simpan data pemesanan 
mysql_query("INSERT INTO orders(nama_kustomer, alamat, telpon, email, tgl_order, jam_order, id_ongkir) 
             VALUES('$nama','$alamat','$telpon','$_POST[email]','$tgl_skrg','$jam_skrg','$_POST[jasa]')");

  
// mendapatkan nomor orders
$id_orders=mysql_insert_id();

// panggil fungsi isi_keranjang dan hitung jumlah produk yang dipesan
$isikeranjang = isi_keranjang();
$jml          = count($isikeranjang);

// simpan data detail pemesanan  
for ($i = 0; $i < $jml; $i++){
  mysql_query("INSERT INTO orders_detail(id_orders, id_produk, jumlah, potongan, harga)
               VALUES('$id_orders',{$isikeranjang[$i]['id_produk']}, {$isikeranjang[$i]['jumlah']},{$isikeranjang[$i]['potongan']},{$isikeranjang[$i]['harga']})");
}
  
// setelah data pemesanan tersimpan, hapus data pemesanan di tabel pemesanan sementara (orders_temp)
for ($i = 0; $i < $jml; $i++) {
  mysql_query("DELETE FROM orders_temp
	  	         WHERE id_orders_temp = {$isikeranjang[$i]['id_orders_temp']}");
}


echo "<div class='full-width-content'>
	  <h3>Proses Simpan Transaksi</h3>
	  </div>
      <div id='main-container1'>
	  <div id='form-container1'>
      
      Data pemesan beserta ordernya adalah sebagai berikut: <br />
      <table width='70%' border='0' cellspacing='0' cellpadding='0'>
	  <tr>
      <td height='30'>Nama</td>
      <td><b>$_POST[nama]</b></td>
      <td>&nbsp;</td>
      </tr>
	  
	  <tr>
      <td height='30'>Alamat lengkap</td>
      <td>$_POST[alamat]</td>
      <td>&nbsp;</td>
      </tr> 
	 
	  <tr>
      <td height='30'>Telpon</td>
      <td>$_POST[telpon]</td>
      <td>&nbsp;</td>
      </tr>
	 
	  <tr>
      <td height='30'>Email</td>
      <td>$_POST[email]</td>
      <td>&nbsp;</td>
      </tr>
	  </table><br />
      
      Nomor Order: <b> $id_orders</b><br /></div>";

      $daftarproduk=mysql_query("SELECT * FROM orders_detail,produk 
                                 WHERE orders_detail.id_produk=produk.id_produk 
                                 AND id_orders='$id_orders'");

echo "<div class='full-width-content'>
      <h3>Pesanan Anda</h3>
      <table cellpadding='0' cellspacing='0'>
	  <tr>
	  <td class='no'><span class='heading'>No.</span></td>
	  <td class='thumbnail'><span class='heading'>Produk</span></td>
	  <td class='product-name'><span class='heading'>Nama Produk</span></td>
	  <td class='berat'><span class='heading'>Berat</span></td>
	  <td class='quantity'><span class='heading'>QTY</span</td>
	  <td class='unit-price'><span class='heading'>Harga</span></td>
	  <td class='subtotal'><span class='heading'>SubTotal</span></td>
      </tr>";
	  
// Kirim Email /////////////////////////////////////////////////////////////////   

$pesan="<table width='600' border='0' cellspacing='0' cellpadding='0'>
		<tbody>
		<tr>
		<td width='250'><p><strong><b>Kantor $iden[nama_website]:</b></strong><br>
		<span class=\"color:#896173;font-size:12px;\">$iden[alamat]</p>
		</td>
		
		<td>&nbsp;</td>
		<td width='147'><a href='$iden[url]' target='_blank'>
		<img src='$iden[url]/aw_logo/$logo[gambar]' width='194' height='68'><a/></td>
		</tr>
		</tbody>
		</table>
		<br/>
		
		<table width='600' border='0' cellspacing='0' cellpadding='0'>
		<tbody>
		<tr bgcolor='#0a9bf7'>
        <td  width='600' height='30' style='font-size: 13px; color:#FFFFFF; text-align:left; padding-left:10px;'>
        Terimakasih telah melakukan pemesanan online di <b>$iden[nama_website]</b></td>
        </tr>
		</tbody>
		</table>
		
		<table border='0' cellpadding='0' cellspacing='0' width='600' style='font-size:13px; color: #000000; 
  background-color:#FFFFFF; margin-top:2px; margin-bottom:2px;'>
       <tbody>
		
		<tr bgcolor='#f0f0f0'>
        <td style='text-align:left; padding-left:10px;'>No. Order</td>
        <td width='350' height='20'>: <b>$id_orders</b></td>
        </tr>
		  
		<tr bgcolor='#ffffff'>
        <td style='text-align:left; padding-left:10px;'>Nama</td>
        <td width='350' height='20'>: $_POST[nama]</td>
        </tr> 
		 
		<tr bgcolor='#f0f0f0'>
        <td style='text-align:left; padding-left:10px;'>Alamat</td>
        <td width='350' height='20'>: $_POST[alamat]</td>
        </tr>
		 
		<tr bgcolor='#ffffff'>
        <td style='text-align:left; padding-left:10px;'>Telpon/HP</td>
        <td width='350' height='20'>: $_POST[telpon]</td>
        </tr> 
		</tbody>
        </table>
		
		
		<table border='0' cellpadding='0' cellspacing='0' width='600'>
		<tbody>
		<tr bgcolor='#0a9bf7'>
        <td  width='600' height='30' style='font-size: 13px; color:#FFFFFF; text-align:left; padding-left:10px;'>
        Data order Anda adalah sebagai berikut:</td>
        </tr>
		</tbody>
        </table>
		
		<table border='0' cellpadding='0' cellspacing='0' 
		width='600' style='font-size:13px; color: #000000; background-color:#FFFFFF; margin-top:2px; margin-bottom:2px;'>
  <thead>
        
		<tr>
		<td width='40' height='30' bgcolor='#efefef'>
		<div align='center' class=\"color:#896173;font-size:14px;\"><b>No.</b></div></td>
		<td width='100' height='30' bgcolor='#efefef'>
		<div align='center' class=\"color:#896173;font-size:14px;\"><b>Nama Produk</b></div></td>
		<td width='40' height='30' bgcolor='#efefef'>
		<div align='center' class=\"color:#896173;font-size:14px;\"><b>Berat</b></div></td>
		<td width='50' height='30' bgcolor='#efefef'>
		<div align='center' class=\"color:#896173;font-size:14px;\"><b>Jumlah</b></div></td>
		<td width='80' height='30' bgcolor='#efefef'>
		<div align='center' class=\"color:#896173;font-size:14px;\"><b>Harga</b></div></td>
		<td width='80' height='30' bgcolor='#efefef'>
		<div align='center' class=\"color:#896173;font-size:14px;\"><b>Subtotal</b></div></td>
		</tr>
		<thead>
        </table>";

///////////////////////////////////////////////////////////////////////////////////////////
      
    $no=1;
    while ($d=mysql_fetch_array($daftarproduk)){
    $subtotalberat = $d[berat] * $d[jumlah]; // total berat per item produk 
    $totalberat  = $totalberat + $subtotalberat; // grand total berat all produk yang dibeli
    $disc        = ($d[potongan]/100)*$d[harga];
    $hargadisc   = number_format(($d[harga]-$disc),0,",",".");
    $subtotal    = ($d[harga]-$disc) * $d[jumlah];
    $total       = $total + $subtotal;  
    $subtotal_rp = format_rupiah($subtotal);
    $total_rp    = format_rupiah($total);
    $harga       = format_rupiah($d[harga]);

echo "<tr>
      <td class='no'>$no</td><input type=hidden name=id[$no] value=$d[id_orders_temp]></td>
      <td class='thumbnail'><a href=produk-$d[id_produk]-$d[produk_seo].html><a href='aw_produk/$d[gambar]' rel='prettyPhoto[pp_gal]' 
title='$d[nama_produk]'><img src='aw_produk/$d[gambar]' border='0' width=45/></a></td>
      <td class='product-name'>$d[nama_produk]</td>
      <td class='berat'>$d[berat]</td>
      <td class='quantity'>$d[jumlah]</td>
      <td class='unit-price'>Rp.</span> $hargadisc,-</td>
      <td class='subtotal'>Rp.</span> $subtotal_rp,-</td>
      </tr>";

// Kirim Email ///////////////////////////////////////////////////////////////// 

$pesan.="<table border='0' cellpadding='0' cellspacing='0' width='600'>
		<tr>
		<td width='40' height='30'><center>$no</center></td>
		<td width='100' height='30'><center>$d[nama_produk]</center></td>
		<td width='40' height='30'><center>$d[berat]</center></td>
		<td width='50' height='30'><center>$d[jumlah]</center></td>
		<td width='80' height='30'><center>Rp. $hargadisc,-</center></td>
		<td width='80' height='30'><center>Rp. $subtotal_rp,-</center></td>
		</tr>
		</table>";
$no++;
} 

$ongkos=mysql_fetch_array(mysql_query("SELECT biaya FROM ongkos_kirim WHERE id_ongkir='$_POST[jasa]'"));
$ongkoskirim1=$ongkos[biaya];
$ongkoskirim = $ongkoskirim1 * $totalberat;

$grandtotal    = $total + $ongkoskirim; 

$ongkoskirim_rp = format_rupiah($ongkoskirim);
$ongkoskirim1_rp = format_rupiah($ongkoskirim1); 
$grandtotal_rp  = format_rupiah($grandtotal);  

$pesan.="<table border='0' cellpadding='0' cellspacing='0' width='600'>
        <tr>
		<td width='350' height='25' colspan='5' bgcolor='#efefef'><div align='right'>Total: </div></td>
		<td bgcolor='#efefef'><div align='center'>Rp. $total_rp,-</div></td>
		</tr>
		<tr>
		<td width='350' height='25' colspan='5'><div align='right'>Ongkos Kirim Tujuan Kota Pembeli: </div></td>
		<td><div align='center'>Rp. $ongkoskirim1_rp,- /Kg</div></td>
		</tr>
		<tr>
		<td width='350' height='25' colspan='5' bgcolor='#efefef'><div align='right'>Total Berat Barang: </div></td>
		<td bgcolor='#efefef'><div align='center'>$totalberat /Kg</div></td>
		</tr>
		<tr>
		<td width='350' height='25' colspan='5'><div align='right'>Ongkos Kirim: </div></td>
		<td><div align='center'>Rp. $ongkoskirim_rp,-</div></td>
		</tr>
		<tr>
		<td width='350' height='25' colspan='5' bgcolor='#efefef'><div align='right'><b>Grand Total: </b></div></td>
		<td bgcolor='#efefef'><div align='center'><b>Rp. $grandtotal_rp,-</b></div></td>
		</tr>
		</table>
		
		
		<table width='600' style='font-size:12px; color: #fff; background-color:#0a9bf7; padding:10px;'>
		</tbody>
		<tr>
		<td width='30'>1.</td>
		<td>Apabila Ongkos Kirim nilainya Rp. 0 maka ongkos kirim akan dihitung secara manual. Konfirmasi kepada Kami via SMS ke HP. $iden[tlp] untuk menentukan ongkos kirimnya.</td>
		</tr>
		
		<tr>
		<td width='30'>2.</td>
		<td>
		Apabila Ongkos Kirim tercantum, Silahkan lakukan pembayaran ke Bank Mandiri sebanyak Grand Total yang tercantum, nomor rekeningnya 
	    <b>$rekening[no_rekening] - $rekening[pemilik]</b></td>
		</tr>
		</tbody>
        </table>";

$subjek=".:: Pemesanan Online $iden[nama_website] ::.";

// Kirim email dalam format HTML
$dari = "From: $iden[nama_website] <".$iden[email].">\n";
$dari .= "Content-type: text/html \r\n";

// Kirim email ke kustomer
mail($_POST[email],$subjek,$pesan,$dari);


// Kirim email ke pengelola toko online
mail("$iden[email] ",$subjek,$pesan,$dari);

echo "<tr>
      <td colspan='6' class='unit-price'><span class='summary1'>Total:</span></td>
      <td class='price'><span class='summary1'>Rp. $total_rp,-</span></td>
      </tr>
       
	  <tr>
      <td colspan='6' class='unit-price'><span class='summary1'>Ongkos Kirim Tujuan Kota Pembeli:</span></td>
      <td class='price'><span class='summary1'>Rp. $ongkoskirim1_rp,- /Kg</span></td>
      </tr> 
      
      <tr>
      <td colspan='6' class='unit-price'><span class='summary1'>Total berat barang:</span></td>
      <td class='price'><span class='summary1'>$totalberat /Kg</span></td>
      </tr>
	  
	  <tr>
      <td colspan='6' class='unit-price'><span class='summary1'>Ongkos Kirim:</span></td>
      <td class='price'><span class='summary1'>Rp. $ongkoskirim_rp,-</span></td>
      </tr>
	  
	  <tr>
      <td colspan='6' class='unit-price'><span class='summary1'>GrandTotal:</span></td>
      <td class='price'><span class='summary1'>Rp. $grandtotal_rp,-</span></td>
      </tr>
      </table>";
		
echo "<div class='keterangan'>- Data order dan nomor rekening transfer sudah terkirim ke email Anda. <br />
               - Apabila Anda tidak melakukan pembayaran dalam 3 hari, maka data order Anda akan terhapus (transaksi batal)</p><br />      
              </div>";    
}
else{
echo "<script> alert('Kode yang Anda masukkan tidak cocok');window.location='selesai-belanja.html'</script>";
}
}else{
echo "<script> alert('Anda belum memasukkan kode');window.location='selesai-belanja.html'</script>";
}

}
}
echo "</div>
	  </div>
	  </div>
	  </div>
	  </div>";
	  
?>