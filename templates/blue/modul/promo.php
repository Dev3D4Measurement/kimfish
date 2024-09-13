<?php
// Halaman promo
if ($_GET[module]=='promo'){
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
	  $main=mysql_query("SELECT * FROM mainmenu WHERE aktif='Y' ORDER BY id_order");
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

/////////////////////////////////////////////////////////////////////////////////////////////////////

				
echo "<div class='right'>";
	 // Tampilkan berita	  
     $detail=mysql_query("SELECT * FROM promo WHERE id_promo
                      AND id_promo='".$val->validasi($_GET['id'],'sql')."'");
	  $d   = mysql_fetch_array($detail);
	  	  
      $tgl = tgl_indo($d[tanggal]);
	  $baca = $d[dibaca]+1;
	  mysql_query("UPDATE promo SET dibaca='$baca' WHERE id_promo='".$val->validasi($_GET['id'],'sql')."'");
echo "<div class='descripton2'>
      <div class='thumb'>
      <h2>$d[judul]</h2>
      <div class='postingberita'><div class='waktu'>$d[hari], $tgl  - $d[jam] WIB</div> <div class='posting'> Diposting <b>$d[username]</b> &nbsp;|&nbsp; dibaca <b>$baca</b> pembaca</div></div><br/>
	  </div>";
      if ($d[gambar]!=''){
echo "<img src='aw_banner/$d[gambar]' width='250'>";
      }
echo "<p>$d[keterangan]</p>
      </div>";
      }
echo "</div>
	  
	  </div>
	  <div class='shadow-big'></div>";
	   
?>