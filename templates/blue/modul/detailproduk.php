<?php
// Halaman detailproduk
if ($_GET[module]=='detailproduk'){
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

///////////////////////////////////////////////////////////////////////////////////////////////

echo"<div class='right'>
     <div class='featured'>
	  
     <h2 class='rockwell'></h2> 
     <div class='product_panel products_list'>
	 <div class='product_panel'>
	 <div class='left_panel'>
	 <div class='pic_panel imagecol'>";
	 
	 $detail=mysql_query("SELECT * FROM produk,kategoriproduk    
                      WHERE kategoriproduk.id_kategori=produk.id_kategori 
                      AND id_produk='".$val->validasi($_GET['id'],'sql')."'");
					  
	   $d   = mysql_fetch_array($detail);
	   
echo"<class='thickbox preview_link' href='produk-$r[id_produk]-$r[produk_seo].html'>
     <img class='product_image' id='product_image_84' alt='$r[nama_produk]' title='$r[nama_produk]' src='aw_produk/$d[gambar]' width=250'/>
	 </a>";
	 }
echo"</div>
     </div>";
	 
echo"<div class='right_panel'>
     <div class='AWsocialproduk'><div class='addthis_toolbox addthis_default_style'>
     <a class='addthis_button_preferred_1'></a>
     <a class='addthis_button_preferred_2'></a>
     <a class='addthis_button_preferred_3'></a>
     <a class='addthis_button_preferred_4'></a>
     <a class='addthis_button_compact'></a>
     <a class='addthis_counter addthis_bubble_style'></a>
     </div></div>
     <script type='text/javascript' src='http://s7.addthis.com/js/250/addthis_widget.js#pubid=ra-4f8aab4674f1896a'></script>";
	 
	 $detail=mysql_query("SELECT * FROM produk,kategoriproduk    
                      WHERE kategoriproduk.id_kategori=produk.id_kategori 
                      AND id_produk='".$val->validasi($_GET['id'],'sql')."'");
					  
	 $d   = mysql_fetch_array($detail);
	 $disc        = ($d[potongan]/100)*$d[harga];
     $hargadisc   = number_format(($d[harga]-$disc),0,",",".");
     $subtotal    = ($d[harga]-$disc) * $d[jumlah];
     $total       = $total + $subtotal;  
     $subtotal_rp = format_rupiah($subtotal);
     $total_rp    = format_rupiah($total);
     $harga       = format_rupiah($d[harga]);
     if ($d[stok] >= 1 AND $d[discount]=='N'){
	 
echo"<h2 class='Qlassik_TB'>$d[nama_produk]</h2>
	<p class='availability'>Stok:
	<span id='stock_display_84' class='in_stock'>$d[stok] Item</span>
	</p>
	<div class='price_panel'>
	<p class='current_price pricedisplay 84'>Harga<br/>
	<span id='product_price_84' class='currentprice pricedisplay'><b>Rp. $d[harga]</b></span></p>
	<div class='count'>
     <div class='buy_button_container'>";
	 
				if($_SESSION['kd_user']!= ''){
				
     echo"<a class='button small darkpurple' href='aksi.php?module=keranjang&act=tambah&id=$d[id_produk]'><span><span>Beli Produk</span></span></a>";
	 }else{
	  echo"<a class='button small darkpurple' href='alert.php'><span><span>Beli Produk</span></span></a>";
	  }
	 echo"
     </div>
	  </div>
	</div>
	<div class='description'>
	<div class='info'>
	<div class='info_inside'>
	<p>$d[deskripsi]</p>
	</div>
	</div>
	</div>";
		}
	else
	if ($d[stok] >= 1 AND $d[discount]=='Y'){
echo"<h2 class='Qlassik_TB'>$d[nama_produk]</h2>
     <img width='44' height='42' class='sale_tagdetail' alt='$d[potongan]%'>
	 <p class='availability'>Stok:
	 <span id='stock_display_84' class='in_stock'>$d[stok] Item</span>
	 </p>
	 <div class='price_panel'>
	 <p class='current_price pricedisplay 84'>Harga<br/>
	 <span id='product_price_84' class='currentprice pricedisplay'><s>Rp. $harga</s> - <b>Rp. $hargadisc</b></span></p>
	 
	 <div class='count'>
     <div class='buy_button_container'>
	 ";
	 
				if($_SESSION['kd_user']!= ''){
				
     echo"<a class='button small darkpurple' href='aksi.php?module=keranjang&act=tambah&id=$d[id_produk]'><span><span>Beli Produk</span></span></a>";
	 }else{
	  echo"<a class='button small darkpurple' href='alert.php'><span><span>Beli Produk</span></span></a>";
	  }
	 echo"
     </div>
     </div>
	 </div>
	 <div class='description'>
	 <div class='info'>
	 <div class='info_inside'>
	 <p>$d[deskripsi]</p>
	 </div>
	 </div>
	 </div>";
	 }
	else{
echo"<h2 class='Qlassik_TB'>$d[nama_produk]</h2>
	 <p class='availability'>Stok:
	 <span id='stock_display_84' class='in_stock'>$d[stok] Item</span>
	 </p>
	 <div class='price_panel'>
	 <p class='current_price pricedisplay 84'><br/>
	 <span id='product_price_84' class='currentprice pricedisplay'><b>STOK HABIS</b></span></p>
	 
	 <div class='count'>
     <div class='buy_button_container'>
     <a class='button small darkpurple' href=''><span><span>Stok Habis</span></span></a>
     </div>
     </div>
	 </div>
	 <div class='description'>
	 <div class='info'>
	 <div class='info_inside'>
	 <p>$d[deskripsi]</p>
	 </div>
	 </div>
     </div>";
	 }
	 
echo"<div class=AWfb-like>
	 <div class='fb-like' data-href='$iden[url]/produk-$d[id_produk]-$d[produk_seo].html' data-send='false' 
  data-width='465' data-show-faces='false'></div> </div>
  </div>
	 
	   </div>
	   </div>
	   </div>
	   </div>";
	   
////////////////////////////////////////////////////////////////////////////////////////////////////////
	   
echo"<div class='right'>
      <div class='product1_panel products1_list'>
	  <h2 class='product1_panel'>Produk Lainnya</h2>";
	  
      $sql=mysql_query("SELECT * FROM produk ORDER BY rand() LIMIT 8");
      while ($r=mysql_fetch_array($sql)){
	  
      $disc        = ($r[potongan]/100)*$r[harga];
      $hargadisc   = number_format(($r[harga]-$disc),0,",",".");
      $subtotal    = ($r[harga]-$disc) * $r[jumlah];
      $total       = $total + $subtotal;  
      $subtotal_rp = format_rupiah($subtotal);
      $total_rp    = format_rupiah($total);
      $harga       = format_rupiah($r[harga]);
	  if ($r[stok] >= 1 AND $r[discount]=='Y'){
	  
echo "<div class='product1'>
      <h2><a href='produk-$r[id_produk]-$r[produk_seo].html'>$r[nama_produk]</a></h2>
	  <img width='44' height='42' class='sale_tag' alt='$r[potongan]%'>
	  <a href=produk-$r[id_produk]-$r[produk_seo].html><a href='aw_produk/$r[gambar]' rel='prettyPhoto[pp_gal]' 
title='$r[nama_produk]'><img src='aw_produk/$r[gambar]' border='0' height=130 width=155/></a>
      <div class='product1_name'><p>Stok: $r[stok]</p></div>
      <div class='product1_price'>
      <p><span class='fl strikethrough'>Rp. $harga</span>                                            
	  <div class='harga'>Rp. $hargadisc</div></p>
      </div>
	  <div class='btn'>
	    ";
	 
				if($_SESSION['kd_user']!= ''){
				
     echo"<div class='btn-beli'><a href='aksi.php?module=keranjang&act=tambah&id=$r[id_produk]'>Beli</a></div>";
	 }else{
	  echo"<div class='btn-beli'><a href='alert.php'>Beli</a></div>";
	  }
	 echo"
	  <div class='btn-detail'><a href='produk-$r[id_produk]-$r[produk_seo].html'>Detail</a></div>
	  </div>
	  </div>";
	  }
	  else
	  if ($r[stok] >= 1 AND $r[discount]=='N'){
echo "<div class='product1'>
      <h2><a href='produk-$r[id_produk]-$r[produk_seo].html'>$r[nama_produk]</a></h2>
	  <a href=produk-$r[id_produk]-$r[produk_seo].html><a href='aw_produk/$r[gambar]' rel='prettyPhoto[pp_gal]' 
title='$r[nama_produk]'><img src='aw_produk/$r[gambar]' border='0' height=130 width=155/></a>
      <div class='product1_name'><p>Stok: $r[stok]</p></div>
      <div class='product1_price'>                                           
	  <span class='fr'>Rp. $harga</span></p>
      </div>
	   <div class='btn'>
	  <div class='btn-beli'><a href='aksi.php?module=keranjang&act=tambah&id=$r[id_produk]'>Beli</a></div>
	  <div class='btn-detail'><a href='produk-$r[id_produk]-$r[produk_seo].html'>Detail</a></div>
	  </div>
	  </div>";
	  }
	else{
echo "<div class='product1'>
      <h2><a href='produk-$r[id_produk]-$r[produk_seo].html'>$r[nama_produk]</a></h2>
	  <a href=produk-$r[id_produk]-$r[produk_seo].html><a href='aw_produk/$r[gambar]' rel='prettyPhoto[pp_gal]' 
title='$r[nama_produk]'><img src='aw_produk/$r[gambar]' border='0' height=130 width=155/></a>
      <div class='product1_name'><p>Stok: $r[stok]</p></div>
      <div class='product1_price'>
      <p><span class='stok'></span>    
      </div>
	   <div class='btn'>
	  <div class='btn-beli'>Habis</div>
	  <div class='btn-detail'><a href='produk-$r[id_produk]-$r[produk_seo].html'>Detail</a></div>
	  </div>
	  </div>";
	    }
       }  
echo "
	   </div>
	   </div>
	   </div>
	   </div>";
	 

?>