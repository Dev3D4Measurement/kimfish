<?php
// Halaman Cek Order
if ($_GET[module]=='cekorder'){

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
				
echo "<div class='right'>
      <h2>Status Order </h2>
	  <div class='AWStatus'>";
	   // menghilangkan spasi di kiri dan kanannya
				  $cek = trim($_POST['cek']);
				  // mencegah XSS
				  $cek = htmlentities(htmlspecialchars($cek), ENT_QUOTES);

				 
				  $hasil  = mysql_query("SELECT * FROM orders, ongkos_kirim 
				                                  WHERE orders.id_ongkir=ongkos_kirim.id_ongkir 
										          AND id_orders='$cek'");
				  $ketemu = mysql_num_rows($hasil);
				  $r= mysql_fetch_array($hasil);

				  if ($ketemu == 1){
				  echo "<h2>Status Order Anda    : <b>$r[status_order]</b></h2>";
					if ($r[status_order] == 'Terkirim'){
						echo "<h2> Dengan Nomor Resi : <b>$r[resi]</b></h2>";
						}
					else{
					echo"";
					}
				  echo "<table border=0 width=500>
						<tr><td>Nama Kustomer</td><td> : $r[nama_kustomer]</td></tr>
						<tr><td>Alamat Pengiriman</td><td> : $r[alamat]</td></tr>
						<tr><td>No. Telpon/HP</td><td> : $r[telpon]</td></tr>
						<tr><td>Email</td><td> : $r[email]</td></tr>
						</table>";        
					}                                                          
				  else{
					echo "<p>Tidak ditemukan ID ORDER <b>$cek</b> Silahkan Cek email anda</p>";
				  }
				  }
echo "</div>
	  </div>";

///////////////////////////////////////////////////////////////////////////////////////////////
	  
	  
echo "</div>
      </div>
      </div>
      </div>
	  </div>";
	   
?>