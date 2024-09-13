<?php
if($_GET['module']=='home'){
	echo "<span class='crumb'>Home</span>";
}
elseif($_GET['module']=='menuutama'){
	echo "<span class='crumb'>Menu Utama</span>";
}
elseif($_GET['module']=='submenu'){
	echo "<span class='crumb'>Submenu</span>";
}
elseif($_GET['module']=='identitas'){
	echo "<span class='crumb'>Konfigurasi Website</span>";
}
elseif($_GET['module']=='produk'){
	echo "<span class='crumb'>Produk</span>";	
}
elseif($_GET['module']=='kategoriproduk'){
	echo "<span class='crumb'>Kategori Produk</span>";	
}

elseif($_GET['module']=='berita'){
	echo "<span class='crumb'>Berita</span>";
}
elseif($_GET['module']=='profil'){
	echo "<span class='crumb'>Edit Profil</span>";
}
elseif($_GET['module']=='halamanstatis'){
	echo "<span class='crumb'>Halaman Baru</span>";
}
elseif($_GET['module']=='pemesanan'){
	echo "<span class='crumb'>Cara Pemesanan</span>";
}
elseif($_GET['module']=='hubungi'){
	echo "<span class='crumb'>Kontak Masuk</span>";
}
elseif($_GET['module']=='header'){
	echo "<span class='crumb'>Banner Header</span>";
}
elseif($_GET['module']=='order'){
	echo "<span class='crumb'>Order Masuk</span>";
}
elseif($_GET['module']=='konfirmasi'){
	echo "<span class='crumb'>Konfirmasi Pembayaran</span>";
}
elseif($_GET['module']=='testimonial'){
	echo "<span class='crumb'>Testimonial</span>";
}
elseif($_GET['module']=='download'){
	echo "<span class='crumb'>Download</span>";
}
elseif($_GET['module']=='bank'){
	echo "<span class='crumb'>Rekening Bank</span>";
}
elseif($_GET['module']=='modul'){
	echo "<span class='crumb'>Modul</span>";
}
elseif($_GET['module']=='banner'){
	echo "<span class='crumb'>Banner</span>";
}
elseif($_GET['module']=='promo'){
	echo "<span class='crumb'>Banner Promo</span>";
}
elseif($_GET['module']=='logo'){
	echo "<span class='crumb'>Logo Web</span>";
}
elseif($_GET['module']=='ongkoskirim'){
	echo "<span class='crumb'>Ongkos Kirim</span>";
}
elseif($_GET['module']=='pengiriman'){
	echo "<span class='crumb'>Jasa Pengiriman</span>";
}
elseif($_GET['module']=='user'){
	echo "<span class='crumb'>Manajement User</span>";
}
elseif($_GET['module']=='kota'){
	echo "<span class='crumb'>Kota</span>";
}
elseif($_GET['module']=='propinsi'){
	echo "<span class='crumb'>Propinsi</span>";
}
elseif($_GET['module']=='ym'){
	echo "<span class='crumb'>Yahoo Messenger</span>";
}
elseif($_GET['module']=='welcome'){
	echo "<span class='crumb'>Welcome</span>";
}
elseif($_GET['module']=='templates'){
	echo "<span class='crumb'>Templates</span>";
}
elseif($_GET['module']=='iklan'){
	echo "<span class='crumb'>Banner Pasang Iklan</span>";
}
elseif($_GET['module']=='laporan'){
	echo "<span class='crumb'>Laporan Penjualan</span>";
}
elseif($_GET['module']=='poling'){
	echo "<span class='crumb'>Jajak Pendapat</span>";
}
elseif($_GET['module']=='detailproduk'){
	$detail	=mysql_query("SELECT * FROM produk,kategori    
                      WHERE kategori.id_kategori=produk.id_kategori 
                      AND id_produk='$_GET[id]'");
	$d		= mysql_fetch_array($detail);
	echo "<div class=crumb>
	<a href='store'>Beranda</a>
	<li><a href=kategori-$d[id_kategori]-$d[kategori_seo].html > $d[nama_kategori]</a>
	<li>$d[nama_produk]</li>
	</div>";
}
elseif($_GET['module']=='detailkategori'){
	$detail	=mysql_query("SELECT nama_kategori from kategori where id_kategori='$_GET[id]'");
	$d		= mysql_fetch_array($detail);
	echo "<div class=crumb>
	<a href='store'>Beranda</a>
	<li>$d[nama_kategori]
	</div>";
}
?>
