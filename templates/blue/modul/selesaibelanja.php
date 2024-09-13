<?php
// Halaman utama (keranjang belanja)
if ($_GET[module]=='selesaibelanja'){
 $iden=mysql_fetch_array(mysql_query("SELECT url FROM identitas"));
//================================================================================================================

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


echo"<div class='featured'>
	 <div class='full-width-content'>
	 <h3>Selesai Belanja</h3>
	 </div>
	 <div id='main-container1'>
	 <div id='form-container1'>";
	 
	 $sid = session_id();
     $sql = mysql_query("SELECT * FROM orders_temp, produk 
			                WHERE id_session='$sid' AND orders_temp.id_produk=produk.id_produk");
     $ketemu=mysql_num_rows($sql);
     if($ketemu < 1){
echo"<script> alert('Keranjang belanja masih kosong');window.location='$iden[url]'</script>\n";
   	 exit(0);
	 }
	 else{
  
echo"<form name=form class='formGen' action=simpan-transaksi.html method=POST onSubmit=\"return validasi(this)\">
	 
	  <div class='formRow'>
      <label for='field0'>
      Nama Lengkap<span class='star'> *</span></label>
      <input type='text' name='nama' id='nama' class='textField required' />
      </div>
		
	  <div class='formRow'>
      <label for='field0'>
      No. Telepon<span class='star'> *</span></label>
      <input type='text' name='telpon' id='telpon' class='textField required' />
      </div>
		
	  <div class='formRow'>
      <label for='field0'>
      Email<span class='star'> *</span></label>
      <input type='text' name='email' id='email' class='textField required' />
      </div>
	  
	  <div class='formRow'>
      <label for='field0'>
      Alamat<span class='star'> *</span></label>
      <input type='text' name='alamat' id='alamat' class='textField required' />
      </div>
	  
	  <div class='formRow'>
      <label for='propinsi'>
      Propinsi<span class='star'> *</span></label>
      <select name='propinsi' id='propinsi' class='select'>
      <option> - Pilih Propinsi -</option>";
	   $tampil=mysql_query("SELECT * FROM propinsi ORDER BY id_propinsi");
      while($r=mysql_fetch_array($tampil)){
echo "<option value=$r[id_propinsi]>$r[nama_propinsi]</option>";
          }
echo "</select>
      </div>
	  
	  <div class='formRow'>
      <label for='kota'>
      Kota Tujuan<span class='star'> *</span></label>
      <select name='kota' id='kota' class='select'>
      <option> - Pilih Kota Tujuan -</option>
      </select>
      </div>
		
	  <div class='formRow'>
      <label for='jasa'>
      Jasa Pengiriman<span class='star'> *</span></label>
      <select name='jasa' id='jasa' class='select'>
      <option> - Pilih Jasa Pengiriman -</option>
      </select>
      </div>
	  
	  <div class='formRow'>
      <label for='ongkir'>
      Ongkos Kirim<span class='star'> *</span></label>
	  <input type='text' id='ongkos' name='ongkos' size='10' disabled>
      </div>";
	  
	  
echo "<div class='formRow'>
      <label for='ongkir'></label>
	  *)  Apabila tidak terdapat nama kota tujuan Anda, pilih <b>Lainnya</b>
      </div>
	  
	  <div class='formRow'>
      <label for='ongkir'></label>
      **) Ongkos kirim dihitung berdasarkan kota tujuan
      </div>

	  <div class='formRow'>
      <label for='ongkir'></label>
	  <img src='captcha/captcha_code_file.php?rand=<?php echo rand(); ?>' id='captchaimg' >
      </div>
	  
	  <div class='formRow'>
      <label for='ongkir'></label>
	  (Masukkan 6 kode diatas)
      </div>
	  
	  <div class='formRow'>
      <label for='ongkir'></label>
	  <input id='kode' name='kode' type='text'><br>
      </div>
	  <div class='formRow'>
      <label for='ongkir'></label>
	  <small>huruf tidak ke baca? klik <a href='javascript: refreshCaptcha();'>disini</a> refresh</small>
      </div>
	  
	 <div class='formRow'>
     <input type='submit' value='Kirim' id='submit' />
      </div>
	  
	  </form>
	  </div>";
	  		  
		  
echo "<div class='full-width-content'>
      <h3>Konfirmasi Keranjang Belanja Anda</h3>
      <table cellpadding='0' cellspacing='0'>
	  <tr>
	  <td class='no'><span class='heading'>No.</span></td>
	  <td class='remove'><span class='heading'>Hapus</span></td>
	  <td class='thumbnail'><span class='heading'>Produk</span></td>
	  <td class='product-name'><span class='heading'>Nama Produk</span></td>
	  <td class='berat'><span class='heading'>berat</span></td>
	  <td class='quantity'><span class='heading'>QTY</span></td>
	  <td class='unit-price'><span class='heading'>Harga</span></td>
	  <td class='subtotal'><span class='heading'>SubTotal</span></td>
	  </tr>";
  
 $no=1;
  while($r=mysql_fetch_array($sql)){
    $subtotalberat = $d[berat] * $d[jumlah]; // total berat per item produk 
    $totalberat  = $totalberat + $subtotalberat; // grand total berat all produk yang dibeli
    $disc        = ($r[potongan]/100)*$r[harga];
    $hargadisc   = number_format(($r[harga]-$disc),0,",",".");
    $subtotal    = ($r[harga]-$disc) * $r[jumlah];
    $total       = $total + $subtotal;  
    $subtotal_rp = format_rupiah($subtotal);
    $total_rp    = format_rupiah($total);
    $harga       = format_rupiah($r[harga]); 
echo "<tr>
       <td class='no'>$no</td><input type=hidden name=id[$no] value=$r[id_orders_temp]></td>
      <td class='remove'><a href='aksi.php?module=keranjang&act=hapus&id=$r[id_orders_temp]' onClick=\"return confirm('Anda yakin produk ini akan dihapus?');\">
	<img src=$f[folder]/images/delete_icon.png border=0 title=Hapus></a></td>
            <td class='thumbnail'><a href=produk-$r[id_produk]-$r[produk_seo].html><a href='aw_produk/$r[gambar]' rel='prettyPhoto[pp_gal]' 
title='$r[nama_produk]'><img src='aw_produk/$r[gambar]' border='0' width=45/></a></td>
            <td class='product-name'>$r[nama_produk]</td>
            <td class='berat'>$r[berat]</td>
            <td class='quantity'> <select name='jml[$no]' value=$r[jumlah] onChange='this.form.submit()'>";
     for ($j=1;$j <= $r[stok];$j++){
     if($j == $r[jumlah]){
echo "<option selected>$j</option>";}
     else{
echo "<option>$j</option>";}}
echo"</select></td>
            <td class='unit-price'>Rp. $hargadisc</td>
            <td class='subtotal'>Rp. $subtotal_rp</td>
          </tr>";
		  
		   $no++;  
 }
echo"<tr class='promo'>
	 <td colspan='6' class='unit-price'></td>
	 <td class='price'><span class='summary'>Total</span></td>
	 <td class='price'><span class='summary'>Rp. $total_rp</td>
	 </tr>
	 
	 <tr class='last submit'>
	 <td colspan='6' class='unit-price'></td>
	
	 </tr>
	 <tr>
	 </tr>
	 </table>
	 </div>";

  }
 }
echo "</div>
	  </div>
	  </div>";
	  
?>