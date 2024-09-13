<?php
error_reporting(0);
session_start();
if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{

include "class.ezpdf.php";
include "../../../config/koneksi.php";
include "rupiah.php";
  
$pdf = new Cezpdf();
 
// Set margin dan font
$pdf->ezSetCmMargins(3, 3, 3, 3);
$pdf->selectFont('fonts/Courier.afm');

$all = $pdf->openObject();

// Tampilkan logo
$pdf->setStrokeColor(0, 0, 0, 1);
$pdf->addJpegFromFile('logo.jpg',20,800,100);

// Teks di tengah atas untuk judul header
$pdf->addText(220, 820, 16,'<b>Laporan Penjualan</b>');
$pdf->addText(240, 800, 18,'<b>SEA MALAKA </b>');
// Garis atas untuk header
$pdf->line(10, 795, 578, 795);

// Garis bawah untuk footer
$pdf->line(10, 50, 578, 50);
// Teks kiri bawah
$pdf->addText(30,34,8,'Dicetak tgl:' . date( 'd-m-Y, H:i:s'));

$pdf->closeObject();

// Tampilkan object di semua halaman
$pdf->addObject($all, 'all');

// Baca input tanggal yang dikirimkan user
$mulai=$_POST[thn_mulai].'-'.$_POST[bln_mulai].'-'.$_POST[tgl_mulai];
$selesai=$_POST[thn_selesai].'-'.$_POST[bln_selesai].'-'.$_POST[tgl_selesai];

// Query untuk merelasikan kedua tabel di filter berdasarkan tanggal
$sql = mysql_query("SELECT orders.id_orders as faktur,DATE_FORMAT(tgl_order, '%d-%m-%Y') as tanggal,jumlah,harga,potongan, id_produk
                    FROM orders, orders_detail 
                    WHERE (orders_detail.id_orders=orders.id_orders)
                    AND (orders.status_order='Terkirim')
                    AND (orders.tgl_order BETWEEN '$mulai' AND '$selesai')");
$jml = mysql_num_rows($sql);

if ($jml > 0){
$i = 1;
while($r = mysql_fetch_array($sql)){
  $disc     = ($r[potongan]/100)*$r[harga];
  $quantityharga=rp($r[jumlah]*$r[harga]-$disc);
  $hargarp=rp($r[harga]);
  $faktur=$r[faktur];
  $n = mysql_fetch_array(mysql_query("SELECT * FROM produk WHERE id_produk=$r[id_produk]"));
  $data[$i]=array('<b>No</b>'=>$i,
                  '<b>Faktur</b>'=>$faktur,
                  '<b>Tanggal</b>'=>$r[tanggal],
                  '<b>Produk</b>'=>$n[nama_produk],
                  '<b>Qty</b>'=>$r[jumlah],
                  '<b>Harga</b>'=>$hargarp,
				   '<b>Diskon</b>'=>$r[potongan],
                  '<b>Sub Total</b>'=>$quantityharga);
    $total = $total+($r[jumlah]*$r[harga]-$disc);
    $totqu = $totqu + $r[jumlah];
  $i++;
}

$pdf->ezTable($data, '', '', '');

$tot=rp($total);
$pdf->ezText("\n\nTotal keseluruhan : Rp. {$tot}");
$pdf->ezText("\nJumlah yang terjual : {$jml} unit");
$pdf->ezText("Jumlah keseluruhan yg terjual: {$totqu} unit");

// Penomoran halaman
$pdf->ezStartPageNumbers(320, 15, 8);
$pdf->ezStream();
}
else{
  $m=$_POST[tgl_mulai].'-'.$_POST[bln_mulai].'-'.$_POST[thn_mulai];
  $s=$_POST[tgl_selesai].'-'.$_POST[bln_selesai].'-'.$_POST[thn_selesai];
  echo "Tidak ada transaksi/order pada Tanggal $m s/d $s";
}
}
?>
