<?php    
session_start();
//Deteksi hanya bisa diinclude, tidak bisa langsung dibuka (direct open)
if(count(get_included_files())==1)
{
	echo "<meta http-equiv='refresh' content='0; url=http://$_SERVER[HTTP_HOST]'>";
	exit("Direct access not permitted.");
}
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{

//cek hak akses user
$cek=user_akses($_GET[module],$_SESSION[sessid]);
if($cek==1 OR $_SESSION[leveluser]=='admin'){


$iden=mysql_fetch_array(mysql_query("SELECT * FROM identitas"));

$aksi="modul/mod_order/aksi_order.php";
switch($_GET[act]){
  // Tampil order
  default:
echo "<form method=POST action='modul/mod_order/aksi_alldel.php' enctype='multipart/form-data'>
      <div id=main-content> 
      <div class=container_12> 
      <div class=grid_12> 
      </div>";

echo "<div class=grid_12> 
      <div class=block-border> 
      <div class=block-header> 
      <h1>Order Masuk</h1>
      <span></span> 
      </div> 
      <div class=block-content> 
      <table id=table-example class=table>
      <thead> 
      <tr> 
      <th>#</th>
	  <th>No.Order</th>
	  <th>Nama Konsumen</th>
	  <th>Tgl. Order</th>
	  <th>Jam</th>
	  <th>Status</th>
	  <th>No. Resi</th>
	  <th>Aksi</th>
      </tr> 
      </thead>
	  <tbody>";


    if ($_SESSION[leveluser]=='admin'){
      $tampil = mysql_query("SELECT * FROM orders ORDER BY id_orders DESC");
    }
    else{
      $tampil=mysql_query("SELECT * FROM orders 
                           WHERE username='$_SESSION[namauser]'       
                           ORDER BY id_orders DESC");
    }
  
    $no=0;
    while($r=mysql_fetch_array($tampil)){
     $tanggal=tgl_indo($r[tgl_order]);	
	 if($r[status_order]=='Baru'){
echo "<tr class=gradeX> 
      <td><input type=checkbox name=cek[] value=$r[id_orders] id=id$no></td>
	  <td><b>$r[id_orders]</b></td>
	  <td><b>$r[nama_kustomer]</b></td>
	  <td><b>$tanggal</b></td>
	  <td><b>$r[jam_order]</b></td>
	  <td><b>$r[status_order]</b></td>
	  <td><b>$r[resi]</b></td>
      <td class=center><a href='?module=order&act=detailorder&id=$r[id_orders]' title='Edit' class='with-tip'><img src='img/icons/packs/fugue/16x16/icn_baca.png'  height='16' width='16'></a> 
	  <a href='$aksi?module=order&act=hapus&id=$r[id_orders]' title='Hapus' class='with-tip' onClick=\"return confirm('Anda yakin menu ini akan dihapus?');\"><img src='img/icons/packs/fugue/16x16/cross-circle.png'  height='16' width='16'></a>
	  </td></tr>";
	  } 
	  else {
echo "<tr class=gradeX> 
      <td><input type=checkbox name=cek[] value=$r[id_orders] id=id$no></td>
	  <td>$r[id_orders]</td>
	  <td>$r[nama_kustomer]</td>
	  <td>$tanggal</td>
	  <td>$r[jam_order]</td>
	  <td>$r[status_order]</td>
	  <td>$r[resi]</td>
      <td class=center><a href='?module=order&act=detailorder&id=$r[id_orders]' title='Edit' class='with-tip'><img src='img/icons/packs/fugue/16x16/icn_baca.png'  height='16' width='16'></a> 
	  <a href='$aksi?module=order&act=hapus&id=$r[id_orders]' title='Hapus' class='with-tip' onClick=\"return confirm('Anda yakin menu ini akan dihapus?');\"><img src='img/icons/packs/fugue/16x16/cross-circle.png'  height='16' width='16'></a>
	  </td></tr>";
	  }
      $no++;
      }
echo "</tbody></table> ";

      break;    
	  
///////////////////////////////////////////////////////////////////////////////////////////////////////////
  
case "detailorder":

      $edit = mysql_query("SELECT * FROM orders WHERE id_orders='$_GET[id]'");
      $r    = mysql_fetch_array($edit);
      $tanggal=tgl_indo($r[tgl_order]);

       if ($r[status_order]=='Baru'){
        $pilihan_status = array('Baru', 'Lunas', 'Terkirim');
    }
    elseif ($r[status_order]=='Lunas'){
        $pilihan_status = array('Lunas','Terkirim', 'Batal');    
    }
	elseif ($r[status_order]=='Terkirim'){
        $pilihan_status = array('Lunas','Terkirim', 'Batal');    
    }
	else{
        $pilihan_status = array('Baru', 'Lunas', 'Batal', 'Terkirim');    
    }
      $pilihan_order = '';
      foreach ($pilihan_status as $status) {
	  $pilihan_order .= "<option value=$status";
	  if ($status == $r[status_order]) {
	  $pilihan_order .= " selected";
	   }
	  $pilihan_order .= ">$status</option>\r\n";
      }
	  
echo "<div id=main-content> 
      <div class=container_12>
      <div class=grid_12> 
      <div class=block-border> 
      <div class=block-header> 
      <h1>Data order Pembayaran Kustemer</h1>
      <span></span> 
      </div> 
	  <div class=block-content1> 
	  <form method=POST action='$aksi?module=order&act=update' enctype='multipart/form-data'>
	  <table id=table-example class=table>
	  <tbody>
	  <input type=hidden name=id value=$r[id_orders]>
	  <tr><td>No. Order</td><td> $r[id_orders]</td></tr>
	  <tr><td>Tgl. & Jam Order</td> <td> $tanggal & $r[jam_order]</td>
	  <tr><td>Status Order      </td><td><div class='detailorder'>
	  <select name='status_order'>$pilihan_order</select></div>
	  
	  <tr><td>No. Resi</td><td>
	  <div class='detailorder'>";
				if($r[status_order] == 'Terkirim'){
echo"<input type=text name=resi size=30 value=$r[resi]>";
				}
				else{
echo"<input type=text name=resi size=30> *) Masukan No Resi pengiriman JNE atau TKI setelah memilih status order TERKIRIM";
				}
echo"</div><br/>
	  <input type='submit' name='update' class='button' value='Ubah Status'>
	
	  </tbody></table>
	  
	  </form>";
	  
echo "<div class=block-header>
	  <h1>Data Produk</h1>
      <span></span>
      </div> ";
	  
	  
	  $sql2=mysql_query("SELECT * FROM orders_detail, produk 
                     WHERE orders_detail.id_produk=produk.id_produk 
                     AND orders_detail.id_orders='$_GET[id]'");
	  		 
echo "<table id=table-example class=table>
      <thead> 
      <tr> 
      <th>Nama Produk</th>
	  <th>Berat (kg) </th>
	  <th>Jumlah</th>
	  <th>Harga Satuan</th>
	  <th>Sub Total</th>
      </tr> 
      </tr> 
      </thead>";
	  
	  while($s=mysql_fetch_array($sql2)){
	  $subtotalberat = $s[berat] * $s[jumlah]; // total berat per item produk 
	  $totalberat  = $totalberat + $subtotalberat; // grand total berat all produk yang dibeli
	  $disc        = ($s[potongan]/100)*$s[harga];
	  $hargadisc   = number_format(($s[harga]-$disc),0,",",".");
	  $subtotal    = ($s[harga]-$disc) * $s[jumlah];
	  $total       = $total + $subtotal;  
	  $subtotal_rp = format_rupiah($subtotal);
	  $total_rp    = format_rupiah($total);
	  $harga       = format_rupiah($s[harga]);
	  
echo "<tr class=gradeX> 
      <td>$s[nama_produk]</td>
	  <td>$s[berat]</td>
	  <td>$s[jumlah]</td>
	  <td>Rp. $hargadisc</td>
	  <td>Rp. $subtotal_rp</td>
      </tr>";
	  }

 
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////	
	  
    $ongkos=mysql_fetch_array(mysql_query("SELECT * FROM ongkos_kirim o, orders 
	                                       WHERE o.id_ongkir=orders.id_ongkir 
										   AND id_orders='$_GET[id]'"));
    $ongkoskirim1=$ongkos[biaya];

    $ongkoskirim=$ongkoskirim1 * $totalberat;
    $grandtotal    = $total + $ongkoskirim; 

    $ongkoskirim_rp = format_rupiah($ongkoskirim);
    $ongkoskirim1_rp = format_rupiah($ongkoskirim1); 
    $grandtotal_rp  = format_rupiah($grandtotal);	 					    

echo "<tr>
      <td colspan='3' rowspan='5'>&nbsp;</td>
      <td>Total :</td>
      <td>Rp. <b>$total_rp</b></td>
      </tr>
      <tr>
      <td>Ongkos Kirim Tujuan Kota Pembeli :</td>
      <td>Rp. <b>$ongkoskirim1_rp /Kg</b></td>
      </tr>
      <tr>
      <td>Total Berat Barang:</td>
      <td><b>$totalberat Kg</b></td>
      </tr>
      <tr>
      <td>Ongkos Kirim : </td>
      <td>Rp. <b>$ongkoskirim_rp</b></td>
      </tr>
      <tr>
      <td>Grand Total :</td>
      <td>Rp. <b>$grandtotal_rp</b></td>
      </tr>
	  </tbody>
	  </table> ";
	 
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	  
// tampilkan data kustomer
echo "<div class=block-header>
	  <h1>Kirim Faktur Pembelian</h1>
      <span></span>
      </div>
	  
	  <form method=POST action=''>
	  <table id=table-example class=table>
	  <tbody>
	  <tr><td>Nama Pembeli</td><td>$r[nama_kustomer]</td></tr>
	  <tr><td>Alamat Pengiriman</td><td>$r[alamat]</td></tr>
	  <tr><td>No. Telpon/HP</td><td>$r[telpon]</td></tr>
	  <tr><td>Email</td><td>$r[email]</td></tr>
	  </table><tbody></form>";

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	
case "kiriminvoice":     
echo "<div class=block-header>
	  <h1>Kirim Faktur Pembelian</h1>
      <span></span>
      </div>
	  <form method=POST action='?module=order&act=kirimemail'>
	  <p class=inline-small-label> 
      <label for=field4>Kepada</label>
	  <input id=textfield name='email' size=30 value='$r[email]'/>
      </p>
	  
	  <p class=inline-small-label> 
      <label for=field4>Subjek</label>
	  <input id=textfield name='subjek' size=50 value='Faktur Pembelian'/>
      </p>
	  
	  <p class=inline-small-label> 
	  <span class=label>Pesan</span>
	  <textarea name='pesan' style='width: 600px; height: 350px;'>
	  </p>
  
	 <table border='0' cellpadding='0' cellspacing='0' width='580' style='font-size:13px; color: #000000; 
  background-color:#fff; margin-top:2px; margin-bottom:2px;'>
      <tr>
	  <td colspan='2' style='text-align:center; padding-top:10px; padding-bottom:10px;' style='font-size:13px;'>Faktur Pembelian <b>$iden[nama_website]<b/></td>
	  </tr>
	  <tr>
	  <td colspan='2'>Assalamu'alaikum Wr. Wb.</td>
	  </tr>
	  <tr>
	  <td colspan='2'>Kami telah menerima pembayaran order anda sebagai berikut:</td>
	  </tr>
	  </table>
	  <table border='0' cellpadding='0' cellspacing='0' width='580' style='font-size:13px; color: #000000; 
  background-color:#fff; margin-top:2px; margin-bottom:2px;'>
	  <tr>
	  <td style='text-align:left; padding-left:10px;'>No. Order:</td>
	  <td width='480'><b>$r[id_orders]<b></td>
	  </tr>
	  <tr>
	  <td style='text-align:left; padding-left:10px;'>Atas nama:</td>
	  <td width='480'><b>$r[nama_kustomer]<b></td>
	  </tr>
	  <tr>
	  <td style='text-align:left; padding-left:10px;'>Sebesar:</td>
	  <td width='480'><b>Rp. $grandtotal_rp<b></td>
	  </tr>
	  </table>
	  <table border='0' cellpadding='0' cellspacing='0' width='580' style='font-size:13px; color: #000000; 
  background-color:#fff; margin-top:2px; margin-bottom:2px;'>
      <tr>
	  <tr>
	  <td colspan='2'>Dengan ini, Kami sampaikan pula bahwa pesanan Anda telah kami kirim ke alamat:</td>
	  </tr>
	  <tr>
	  <td colspan='2'>$r[alamat]</td>
	  </tr>
	  <tr>
	  <td colspan='2'>Terima kasih telah belanja di Toko Online kami...</td>
	  </tr>
	  <tr>
	  <td colspan='2' height='30'>Salam kami,</td>
	  </tr>
	  <tr>
	  <td colspan='2' height='30'><b>$iden[nama_website]<b/></td>
	  </tr>
	  </table>
	  
      </textarea>
      <div class=block-actions1> 
      <ul class=actions1-right> 
      <li>
      <a class='button red' id=reset-validate-form  onclick=\"location.href='?module=order'\">Batal</a>
      </li> </ul>
      <ul class=actions1-left> 
      <li>
      <input type='submit' name='upload' class='button' value='Kirim'></li> </ul> </div> 
	  </form>";
       break;
	 
////////////////////////////////////////////////////////////////////////////////////////////////////////
    
  case "kirimemail":
  $dari = "From: $iden[nama_website] <".$iden[email].">\n" . 
  $dari .= "Content-type: text/html \r\n";

  mail($_POST[email],$_POST[subjek],$_POST[pesan],$dari);
    echo "<div id=main-content> 
          <div class=container_12>
          <div class=grid_12> 
	      <div class=block-border> 
          <div class=block-header> 
	      <h1>Faktur Pembelian </h1>
          <span></span>
          </div>
		  <div class=block-content>
	      <form  method='post' action=''>
		  <table id=table-example class=table>
	      <tbody>
          <tr><td>Faktur Pembelian telah sukses terkirim ke tujuan</td><td>
          <p>[ <a href=javascript:history.go(-2)>Kembali</a> ]</p> 
		  </tbody></table>
		  </form>";	 		  
    break;  
   }
   //kurawal akhir hak akses module
   } else {
	echo akses_salah();
   }
   }
   ?>
</div> 
</div>
 </div>
  <div class='clear height-fix'></div> 
  </div></div>
