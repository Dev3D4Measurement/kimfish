<?php
session_start();
if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='../../css/style.css' rel='stylesheet' type='text/css'>
 <body class='special-page'>
  <div id='container'>
  <section id='error-number'>
  
  <img src='../../img/lock.png'>
  <h1>MODUL TIDAK DAPAT DIAKSES</h1>
  
  <p><span class style=\"font-size:14px; color:#ccc;\">Untuk mengakses modul, Anda harus login dahulu!</p></span><br/>
  
  </section>
  
  <section id='error-text'>
  <p><a class='button' href='../../index.php'> <b>LOGIN</b> </a></p>
  </section>
  </div>";
}
else{

include "../../../config/koneksi.php";

$module=$_GET[module];
$act=$_GET[act];
$resi = htmlentities($_POST['resi']);

if ($module=='order' AND $act=='hapus'){
  mysql_query("DELETE FROM orders WHERE id_orders='$_GET[id]'"); 
  header('location:../../media.php?module='.$module);
 }
elseif ($module=='order' AND $act=='update'){
   // Update stok barang saat transaksi sukses (Lunas)
   if ($_POST[status_order]=='Terkirim'){ 
    
      // Update untuk mengurangi stok 
      mysql_query("UPDATE produk,orders_detail SET produk.stok=produk.stok-orders_detail.jumlah WHERE produk.id_produk=orders_detail.id_produk AND orders_detail.id_orders='$_POST[id]'");
	  
	  // Update untuk menambahkan produk yang dibeli (best seller = produk yang paling laris)
      mysql_query("UPDATE produk,orders_detail SET produk.dibeli=produk.dibeli+orders_detail.jumlah WHERE produk.id_produk=orders_detail.id_produk AND orders_detail.id_orders='$_POST[id]'");

      // Update status order
      mysql_query("UPDATE orders SET status_order='$_POST[status_order]',resi='$resi' where id_orders='$_POST[id]'");
      header('location:../../media.php?module='.$module);
	  
	   }
	  elseif ($_POST[status_order]=='Lunas' ){ 
      mysql_query("UPDATE orders SET status_order='$_POST[status_order]', resi='Belum Dikirim' where id_orders='$_POST[id]'");
      header('location:../../media.php?module='.$module);
	  
      }	  
	  elseif($_POST[status_order]=='Batal'){
	  mysql_query("UPDATE produk,orders_detail SET produk.stok=produk.stok+orders_detail.jumlah WHERE produk.id_produk=orders_detail.id_produk AND orders_detail.id_orders='$_POST[id]'"); //menambah stok yang tidak jadi dibeli
	  
	  // Update untuk mengurangkan produk yang tidak jadi dibeli ( tidak jd best seller)
      mysql_query("UPDATE produk,orders_detail SET produk.dibeli=produk.dibeli-orders_detail.jumlah WHERE produk.id_produk=orders_detail.id_produk AND orders_detail.id_orders='$_POST[id]'");

      // Update status order
      mysql_query("UPDATE orders SET status_order='$_POST[status_order]' where id_orders='$_POST[id]'");
	  mysql_query("UPDATE orders SET resi='Tidak ada No. Resi' where id_orders='$_POST[id]'");	  
	  header('location:../../media.php?module='.$module);
	  }
 else{
     mysql_query("UPDATE orders SET status_order='$_POST[status_order]' where id_orders='$_POST[id]'");
     header('location:../../media.php?module='.$module);
     }
}
}
?>


