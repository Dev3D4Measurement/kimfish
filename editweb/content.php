<?php
include "../config/koneksi.php";
include "../config/library.php";
include "../config/fungsi_indotgl.php";
include "../config/fungsi_combobox.php";
include "../config/class_paging.php";
include "../config/fungsi_rupiah.php";
$iden=mysql_fetch_array(mysql_query("SELECT * FROM identitas"));

// Bagian Home
if ($_GET['module']=='home'){
  if ($_SESSION['leveluser']=='admin'){
echo "<div id=main-content> 
      <div class=container_12>
      <div class=grid_12> 
      <div class=block-border> 
      <div class=block-header> 
      <h1>Selamat Datang</h1>
      <span></span> 
      </div> 
      <div class=block-content> 
      <p>Hai <b>$_SESSION[namalengkap]</b>, selamat datang di halaman Administrator <b>$iden[nama_website].</b><br> 
          Silahkan klik menu pilihan yang berada di sebelah kiri untuk mengelola website atau pilih ikon-ikon pada Control Panel. </p>

		<p>&nbsp;</p>

 		<ul class='shortcut-list'>
   <li><a href=media.php?module=identitas><img src='img/konfigurasi-web.png'/>Konfigurasi</a></li>
   <li><a href=media.php?module=menuutama><img src='img/menuutama.png'/>Menu Utama</a></li>
   <li><a href=media.php?module=submenu><img src='img/submenu.png'/>Sub Menu</a></li>
   <li><a href=media.php?module=produk><img src='img/produk.png'/>Produk</a></li>
   <li><a href=media.php?module=kategoriproduk><img src='img/kategori.png'/>Kategori Produk</a></li>
   <li><a href=media.php?module=order><img src='img/lihatorder.png'/>Order Masuk</a></li>
   <li><a href=media.php?module=hubungi><img src='img/hubungi.png'/>Pesan Masuk</a></li>
   <li><a href=media.php?module=konfirmasi><img src='img/konfirmasi.png'/>Konfirmasi</a></li>
   <li><a href=media.php?module=testimonial><img src='img/testimonial.png'/>Testimonial</a></li>
   <li><a href=media.php?module=ongkoskirim><img src='img/ongkoskirim.png'/>Ongkos Kirim</a></li>
   <li><a href=media.php?module=pengiriman><img src='img/jasakirim.png'/>Jasa Pengiriman</a></li>
   <li><a href=media.php?module=berita><img src='img/berita.png'/>Berita</a></li>
   <li><a href=media.php?module=logo><img src='img/logo.png'/>Logo Website</a></li>
   <li><a href=media.php?module=templates><img src='img/templat.png'/>Template Website</a></li>
   <li><a href=media.php?module=poling><img src='img/poling.png'/>Jajak Pendapat</a></li>
   <li><a href=media.php?module=bank><img src='img/bank.png'/>Rekening Bank</a></li>
   <li><a href=media.php?module=ym><img src='img/ym.png'/>Modul YM</a></li>
   <li><a href=media.php?module=modul><img src='img/modul.png'/>Modul Web</a></li>
   <li><a href=media.php?module=user><img src='img/user.png'/>User Admin</a></li>
   <li><a href=media.php?module=laporan><img src='img/laporan.png'/>Laporan Keuangan</a></li>
   <li><a href=media.php?module=header><img src='img/header.png'/>Header Website</a></li>
   <li><a href=media.php?module=promo><img src='img/banner.png'/>Banner Promo</a></li>
   <li><a href=media.php?module=halamanstatis><img src='img/add_page.png'/>Halaman</a></li>
   <li><a href=media.php?module=download><img src='img/katalog.png'/>Katalog</a></li>
   

   </ul>


          <p align=right>Login : $hari_ini, ";
  echo tgl_indo(date("Y m d")); 
  echo " | "; 
  echo date("H:i:s");
  echo " WIB</p>";
  
    echo "</div> 
</div>
 </div>
  <div class='clear height-fix'></div> 
  </div></div>";
   } else {
echo "<div id=main-content> 
      <div class=container_12>
      <div class=grid_12> 
      <div class=block-border> 
      <div class=block-header> 
      <h1>Selamat Datang</h1>
      <span></span> 
      </div> 
      <div class=block-content> 
          <p>Hai <b>$_SESSION[namalengkap]</b>, selamat datang di halaman Administrator <b>$iden[nama_website].</b><br> 
          Silahkan klik menu pilihan yang berada di sebelah kiri untuk mengelola website. </p>
		<p>&nbsp;</p>
		<p>&nbsp;</p>
		<p>&nbsp;</p>
		<p>&nbsp;</p>


          <p align=right>Login : $hari_ini, ";
  echo tgl_indo(date("Y m d")); 
  echo " | "; 
  echo date("H:i:s");
  echo " WIB</p>";
    echo "</div> 
</div>
 </div>
  <div class='clear height-fix'></div> 
  </div></div>";

   	}
}
  
// Bagian User
elseif ($_GET['module']=='user'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION[leveluser]=='user'){
    include "modul/mod_users/users.php";
  }
}
// Bagian Menu Utama
elseif ($_GET['module']=='menuutama'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION[leveluser]=='user'){
    include "modul/mod_menuutama/menuutama.php";
  }
}
// Bagian Submenu
elseif ($_GET['module']=='submenu'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION[leveluser]=='user'){
    include "modul/mod_submenu/submenu.php";
  }
}
// Bagian Berita
elseif ($_GET['module']=='berita'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='user'){
    include "modul/mod_berita/berita.php";                            
  }
}
// Bagian Produk
elseif ($_GET['module']=='produk'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='user'){
    include "modul/mod_produk/produk.php";                            
  }
}
// Bagian Kategori Produk
elseif ($_GET['module']=='kategoriproduk'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='user'){
    include "modul/mod_kategoriproduk/kategoriproduk.php";                            
  }
}
// Bagian HalamanStatis
elseif ($_GET['module']=='halamanstatis'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='user'){
    include "modul/mod_halamanstatis/halamanstatis.php";                            
  }
}
// Bagian Profil
elseif ($_GET['module']=='profil'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='user'){
    include "modul/mod_profil/profil.php";                            
  }
}
// Bagian Download
elseif ($_GET['module']=='download'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='user'){
    include "modul/mod_download/download.php";                            
  }
}
// Bagian Pemesanan
elseif ($_GET['module']=='pemesanan'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='user'){
    include "modul/mod_pemesanan/pemesanan.php";                            
  }
}
// Bagian Hubungi
elseif ($_GET['module']=='hubungi'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='user'){
    include "modul/mod_hubungi/hubungi.php";                            
  }
}
// Bagian Header
elseif ($_GET['module']=='header'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='user'){
    include "modul/mod_header/header.php";                            
  }
}
// Bagian Banner Promo
elseif ($_GET['module']=='promo'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='user'){
    include "modul/mod_promo/promo.php";                            
  }
}
// Bagian Poling
elseif ($_GET['module']=='poling'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='user'){
    include "modul/mod_poling/poling.php";                            
  }
}
// Bagian modul
elseif ($_GET['module']=='modul'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='user'){
    include "modul/mod_modul/modul.php";                            
  }
}
// Bagian Logo
elseif ($_GET['module']=='logo'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='user'){
    include "modul/mod_logo/logo.php";                            
  }
}
// Bagian Identitas
elseif ($_GET['module']=='identitas'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='user'){
    include "modul/mod_identitas/identitas.php";                            
  }
}
// Bagian konfirmasi
elseif ($_GET['module']=='konfirmasi'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='user'){
    include "modul/mod_konfirmasi/konfirmasi.php";                            
  }
}
// Bagian pemesanan
elseif ($_GET['module']=='pemesanan'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='user'){
    include "modul/mod_pemesanan/pemesanan.php";                            
  }
}
// Bagian Rek. Bank
elseif ($_GET['module']=='bank'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='user'){
    include "modul/mod_bank/bank.php";                            
  }
}
// Bagian Ongkos kirim
elseif ($_GET['module']=='ongkoskirim'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='user'){
    include "modul/mod_ongkoskirim/ongkoskirim.php";                            
  }
}
// Bagian Jasa Pengiriman
elseif ($_GET['module']=='pengiriman'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='user'){
    include "modul/mod_pengiriman/pengiriman.php";                            
  }
}
// Bagian Kota
elseif ($_GET['module']=='kota'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='user'){
    include "modul/mod_kota/kota.php";                            
  }
}
// Bagian Propinsi
elseif ($_GET['module']=='propinsi'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='user'){
    include "modul/mod_propinsi/propinsi.php";                            
  }
}
// Bagian Order
elseif ($_GET['module']=='order'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='user'){
    include "modul/mod_order/order.php";                            
  }
}
// Bagian Testimonial
elseif ($_GET['module']=='testimonial'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='user'){
    include "modul/mod_testimonial/testimonial.php";                            
  }
}
// Bagian Yahoo Messenger
elseif ($_GET['module']=='ym'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='user'){
    include "modul/mod_ym/ym.php";                            
  }
}
// Bagian Welcome
elseif ($_GET['module']=='welcome'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='user'){
    include "modul/mod_welcome/welcome.php";                            
  }
}
// Bagian Templates
elseif ($_GET['module']=='templates'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='user'){
    include "modul/mod_templates/templates.php";                            
  }
}
// Bagian Laporan
elseif ($_GET['module']=='laporan'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='user'){
    include "modul/mod_laporan/laporan.php";                            
  }
}
// Apabila modul tidak ditemukan
else{
  echo "<p><b>MODUL BELUM ADA ATAU BELUM LENGKAP</b></p>";
}

?>
