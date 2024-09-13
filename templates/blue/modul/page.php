<?php
// Halaman halamanstatis
if ($_GET[module]=='halamanstatis'){
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
				
///////////////////////////////////////////////////////////////////////////////////////////////
				
echo "<div class='right'>";
	 $detail=mysql_query("SELECT * FROM halamanstatis 
                      WHERE id_halaman='".$val->validasi($_GET['id'],'sql')."'");
	 $d   = mysql_fetch_array($detail);
echo "<div class='AWprofil'>
      <div class='thumb'>
      <h2>$d[judul]</h2>";
      if ($d[gambar]!=''){
echo "<img src='aw_statis/$d[gambar]' width='350'>";
      }
echo "<p>$d[isi_halaman]</p>
      </div>
	  </div>";

///////////////////////////////////////////////////////////////////////////////////////////////
	  
echo "<br/><h2>Produk</h2>
      <div class='product1_panel products1_list'>";
	  
      $sql=mysql_query("SELECT * FROM produk ORDER BY rand() LIMIT 12");
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
	  <div class='btn-beli'><a href='aksi.php?module=keranjang&act=tambah&id=$r[id_produk]'>Beli</a></div>
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
echo "</div>
      </div>
      </div>
	  </div>
	  </div>";
	   }
?>