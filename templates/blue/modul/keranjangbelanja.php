<?php
// Halaman utama (keranjang belanja)
if ($_GET[module]=='keranjangbelanja'){
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
	   ?>
	  
	  <?php 
				if($_SESSION['kd_user']!= ''){
				?>
				
				
				<li ><b><a href="produk.html"  >Produk</a></b></li>
				<li><b><a  href="konfirmasi.html"  >Konfirmasi</a></b></li>
				
				<li><b><a  href="logout.php"  >Logout</a></b></li>
				
				<?php 
				}else{
				?>
				<li ><b><a href="produk1.html"  >Produk</a></b></li>
				<li ><b><a href="profil.html"  >Profil</a></b></li>
				
				<li ><b><a href="cara-pemesanan.html"  >Cara Pemesanan</a></b></li>
				
				<li ><b><a href="hubungi-kami.html"  >Hubungi Kami</a></b></li>
				
				
				<li ><b><a href="login.html"  >Login</a></b></li>
				
				
				<?php 	
				}
				?>	  
	  
	  <?php
	  
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
	 $sid = session_id();
      $sql = mysql_query("SELECT * FROM orders_temp, produk 
                          WHERE id_session='$sid' AND orders_temp.id_produk=produk.id_produk");
      $ketemu=mysql_num_rows($sql);
  
       if($ketemu < 1){
  
echo "<a href='produk.html'><div class='peringatan'>Keranjang Belanja Anda masih kosong. 
      Silahkan Anda berbelanja terlebih dahulu.</div></a><br/></div>"; }

      else{  
  
echo "<div class='full-width-content'>
      <h3>Keranjang Belanja</h3>
	  <form method=post action=aksi.php?module=keranjang&act=update>
	  <table cellpadding='0' cellspacing='0'>
	  <tr>
	  <td class='no'><span class='heading'>No.</span></td>
	  <td class='remove'><span class='heading'>Remove</span></td>
	  <td class='thumbnail'><span class='heading'>Produk</span></td>
	  <td class='product-name'><span class='heading'>Nama Produk</span></td>
	  <td class='berat'><span class='heading'>berat</span></td>
	  <td class='quantity'><span class='heading'>QTY</span></td>
	  <td class='unit-price'><span class='heading'>Harga</span></td>
	  <td class='subtotal'><span class='heading'>SubTotal</span></td>
	  </tr>";
  
   $no=1;
    while($r=mysql_fetch_array($sql)){
  
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
	 </form>
	 </table>
	 </div>
	 <div class='btn-proses'>
	 <a class='button small darkpurple' href='$iden[url]'><span><span>Lanjutkan Belanja</span></span></a>
	 <a class='button small darkpurple' href='selesai-belanja.html'><span><span>Selesai Belanja</span></span></a></div>
	 
	 <div class='keterangan'>
      *  Total harga di atas belum termasuk ongkos kirim yang akan dihitung saat <b>Selesai Belanja</b>
      </div>";  
  }
 }

echo "</div>
      </div>
	  </div>";
	  
?>