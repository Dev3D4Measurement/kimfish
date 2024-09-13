<?php
// Halaman hasilpencarian
if ($_GET[module]=='hasilpencarian'){
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
				
echo "<div class='right'>";
	  // menghilangkan spasi di kiri dan kanannya
      $kata = trim($_POST['kata']);
      // mencegah XSS
      $kata = htmlentities(htmlspecialchars($kata), ENT_QUOTES);

      // pisahkan kata per kalimat lalu hitung jumlah kata
      $pisah_kata = explode(" ",$kata);
      $jml_katakan = (integer)count($pisah_kata);
      $jml_kata = $jml_katakan-1;

      $cari = "SELECT * FROM produk WHERE " ;
      for ($i=0; $i<=$jml_kata; $i++){
      $cari .= "deskripsi LIKE '%$pisah_kata[$i]%' OR nama_produk LIKE '%$pisah_kata[$i]%'";
      if ($i < $jml_kata ){
      $cari .= " OR ";
      }
       }
      $cari .= " ORDER BY id_produk DESC LIMIT 12";
      $hasil  = mysql_query($cari);
      $ketemu = mysql_num_rows($hasil);
  
echo "<h2>Hasil Pencarian</h2>";
      if ($ketemu > 0){

echo "<div class='temu'>Ditemukan <b>$ketemu</b> produk dengan kata <b>$kata</b> <b>:</b> </div>";

      while($d=mysql_fetch_array($hasil)){
	  
      $isi_produk = htmlentities(strip_tags($d['deskripsi'])); // mengabaikan tag html
      $isi = substr($isi_produk,0,200); // ambil sebanyak 250 karakter
      $isi = substr($isi_produk,0,strrpos($isi," ")); // potong per spasi kalimat
	  
	  $disc        = ($d[potongan]/100)*$d[harga];
      $hargadisc   = number_format(($d[harga]-$disc),0,",",".");
      $subtotal    = ($d[harga]-$disc) * $d[jumlah];
      $total       = $total + $subtotal;  
      $subtotal_rp = format_rupiah($subtotal);
      $total_rp    = format_rupiah($total);
      $harga       = format_rupiah($d[harga]);
	  if ($d[stok] >= 1 AND $d[discount]=='N'){
	  
echo "<div class='listing'>
	  <ul id='test' class='display'>
	  <li class='big'>
	  <div class='big_li_sec'>
	  <a href=produk-$d[id_produk]-$d[produk_seo].html><a href='aw_produk/$d[gambar]'rel='prettyPhoto[pp_gal]' title='$d[nama_produk]'>
	  <img src='aw_produk/$d[gambar]' border='0' height=150 width=150/></a>
	  <p class='colr bold price1'>Rp. $harga,-</p>
	
	  </div>
	  <div class='big_li_sec_right'>
	  <h2><a href='produk-$d[id_produk]-$d[produk_seo].html' class='ptitle2 product_title3'>$d[nama_produk]</a></h2>
	  <ul class='postin'>
	  <li><a href='#'>Stok : $d[stok]</a></li>
	  </ul>
	  <h4 class='black'>Description</h4>
	  <p>$isi ... <a href=produk-$d[id_produk]-$d[produk_seo].html></a></p>
	  <a href='produk-$d[id_produk]-$d[produk_seo].html' class='simplebtnsmall '><span>Detail</span></a>
	  <a href='aksi.php?module=keranjang&act=tambah&id=$t[id_produk]' class='simplebtnsmall'><span>Beli Produk</span></a>
	  </div>
	  </li>
	  </ul>
	  </div>";
	  }
	  else
	  if ($d[stok] >= 1 AND $d[discount]=='Y'){
echo "<div class='listing'>
	  <ul id='test' class='display'>
	  <li class='big'>
	  <div class='big_li_sec'>
	  <a href=produk-$d[id_produk]-$d[produk_seo].html>
	  <a href='aw_produk/small_$d[gambar]'rel='prettyPhoto[pp_gal]' title='$d[nama_produk]'>
	  <img src='aw_produk/$d[gambar]' border='0' height=150 width=150/></a>
	  <span class='sale'>$d[potongan]%</span>
	  <p class='colr bold price'>Rp. $harga,-</p>
	  <p class='colr bold diskon'>Rp. $hargadisc,-</p>
	  </div>
	  <div class='big_li_sec_right'>
	  <h2><a href='produk-$d[id_produk]-$d[produk_seo].html' class='ptitle2 product_title3'>$d[nama_produk]</a></h2>
	  <ul class='postin'>
	  <li>Stok : $d[stok]</li>
	  </ul>
	  <h4 class='black'>Description</h4>
	  <p>$isi ... <a href=produk-$d[id_produk]-$d[produk_seo].html></a></p>
	  <a href='produk-$d[id_produk]-$d[produk_seo].html' class='simplebtnsmall'><span>Detail</span></a>
	  <a href='aksi.php?module=keranjang&act=tambah&id=$d[id_produk]' class='simplebtnsmall'><span>Beli Produk</span></a>
	  </div>
	  </li>
	  </ul>
	 </div>"; 
	  }
	  else{
echo "<div class='listing'>
	  <ul id='test' class='display'>
	  <li class='big'>
	  <div class='big_li_sec'>
	  <a href=produk-$d[id_produk]-$d[produk_seo].html>
	  <a href='aw_produk/small_$d[gambar]'rel='prettyPhoto[pp_gal]' title='$d[nama_produk]'>
	  <img src='aw_produk/$d[gambar]' border='0' height=150 width=158/></a>
	  </div>
	  <div class='big_li_sec_right'>
	  <h2><a href='produk-$d[id_produk]-$d[produk_seo].html' class='ptitle2 product_title3'>$d[nama_produk]</a></h2>
	  <ul class='postin'>
	  <li class='stok'><a href=''>Stok : $d[stok]</a></li>
	  </ul>
	  <h4 class='black'>Description</h4>
	  <p>$isi ... <a href=produk-$d[id_produk]-$d[produk_seo].html></a></p>
	  <a href='produk-$d[id_produk]-$d[produk_seo].html' class='simplebtnsmall'><span>Detail</span></a>
	  <a href='aksi.php?module=keranjang&act=tambah&id=$d[id_produk]' class='simplebtnsmall'><span>Beli Produk</span></a>
	  </div>
	  </li>
	  </ul>
	  </div>"; 
	   }
	    }
		}
		else{
    echo "<div class='welcome'>Tidak ditemukan produk dengan kata <font style='background-color:#FF9900'><b>$kata</b></div>";
  }
echo "</div>
      </div>
      </div>
	  </div>";
	   }
?>