<?php
session_start();

$_SESSION['n1'] = rand(1,20);
$_SESSION['n2'] = rand(1,20);
$_SESSION['expect'] = $_SESSION['n1']+$_SESSION['n2'];

// Halaman konfirmasi
if ($_GET[module]=='konfirmasi'){
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
				
echo "<div class='right'>
      <h2>Konfirmasi Pembayaran</h2>
	  <div id='main-container'>
	  <div id='form-container'>";
	  $sql=mysql_query("SELECT * FROM konfirmasi,mod_bank WHERE konfirmasi.id_bank=mod_bank.id_bank");
      while($b=mysql_fetch_array($sql)){
	   }
echo "<form id='contact-form' name='contact-form' method='post' action='$f[folder]/config/proses_konfirmasi.php'>
	  <table width='75%' border='0' cellspacing='0' cellpadding='0'>
	  <tr>
      <td height='40'><label for='namalengkap'>Nama Lengkap</label></td>
      <td><input type='text' class='validate[custom[namalengkap]]' name='namalengkap' id='namalengkap' value='' /></td>
      <td id='errOffset'>&nbsp;</td>
      </tr>
		
	  <tr>
      <td height='40'><label for='tlp'>No. Tlp</label></td>
      <td><input type='text' class='validate[custom[telephone]]' name='tlp' id='tlp' value='' /></td>
      <td id='errOffset'>&nbsp;</td>
      </tr>
		
	  <tr>
      <td height='40'><label for='email'>Email</label></td>
      <td><input type='text' class='validate[custom[email]]' name='email' id='email' value='' /></td>
      <td>&nbsp;</td>
      </tr>
		
      <tr>
      <td height='40'><label for='noorder'>No. Order</label></td>
      <td><input type='text' class='validate[custom[noorder]]' name='noorder' id='noorder' value='' /></td>
      <td>&nbsp;</td>
      </tr>
		
	  <tr>
      <td height='40'><label for='tglpembayaran'>Tgl. Pembayaran</label></td>
      <td><input type='text' class='validate[custom[tglpembayaran]]' name='tglpembayaran' id='tglpembayaran' value='' /></td>
      <td>&nbsp;</td>
      </tr>
		
	  <tr>
      <td height='40'><label for='jmlhpembayaran'>Jumlah Pembayaran</label></td>
      <td><input type='text' class='validate[custom[jmlhpembayaran]]' name='jmlhpembayaran' id='jmlhpembayaran' value='' /></td>
      <td>&nbsp;</td>
      </tr>
		
	  <tr>
      <td height='40'><label for='subject'>Bank Tujuan</label></td>
      <td><select name='bank' id='subject'>
      <option value='' selected='selected'> - Pilih jenis bank -</option>";
            $tampil=mysql_query("SELECT * FROM mod_bank ORDER BY nama_bank");
       while($r=mysql_fetch_array($tampil)){
       echo "<option  value='$r[id_bank]'>$r[nama_bank] - No.Rek $r[no_rekening]</option>";
          }
       echo "</select></td>
          <td>&nbsp;</td>
        </tr>
		
		<tr>
          <td height='40'><label for='norekening'>No. Rekening</label></td>
          <td><input type='text' class='validate[custom[norekening]]' name='norekening' id='norekening' value='' /></td>
          <td>&nbsp;</td>
        </tr>
		
		<tr>
          <td height='40'><label for='namarekening'>Atas Nama</label></td>
          <td><input type='text' class='validate[custom[namarekening]]' name='namarekening' id='namarekening' value='' /></td>
          <td>&nbsp;</td>
        </tr>
		
		<tr>
          <td height='60' valign='top'><label for='pesan'>Pesan</label></td>
          <td><textarea name='pesan' id='pesan' class='validate[required,[pesan]]' cols='35' rows='5'></textarea></td>
          <td valign='top'>&nbsp;</td>
        </tr>
		
		<tr>
          <td height='50'><label for='captcha'>".$_SESSION['n1']." + ".$_SESSION['n2']." =</label></td>
          <td><input type='text' class='validate[custom[onlyNumber]]' name='captcha' id='captcha' /></td>
          <td valign='top'>&nbsp;</td>
        </tr>
		
		<tr>
          <td valign='top'>&nbsp;</td>
          <td colspan='2'><input type='submit' name='button' id='button' value='kirim' />
          <input type='reset' name='button2' id='button2' value='Reset' />
           ".$str." <img id='loading' src='$f[folder]/images/ajax-load.gif' width='16' height='16' alt='loading' /></td>
        </tr>
	  </table>
	  </form>";
         }
echo "</div>
	  </div>
	  </div>
	  </div>";

///////////////////////////////////////////////////////////////////////////////////////////////
	  
	  
echo "</div>";
	   
?>