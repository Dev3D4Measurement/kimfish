<?php
if($_GET['module']=='store'){
	echo "<span class='crumb'>Beranda</span>";
}
elseif($_GET['module']=='profilkami'){
	echo "<span class='crumb'>Profil</span>";
}
elseif($_GET['module']=='crumb'){
	echo "<span class='crumb'>Cara Pembelian</span>";
}
elseif($_GET['module']=='semuaproduk'){
	echo "<span class='crumb'>Semua Produk</span>";	
}
elseif($_GET['module']=='carabeli'){
	echo "<span class='crumb'>Cara Pembelian</span>";	
}

elseif($_GET['module']=='semuadownload'){
	echo "<span class='crumb'>Download Katalog</span>";
}

elseif($_GET['module']=='keranjangbelanja'){
	echo "<span class='crumb'>Keranjang Belanja</span>";
}
elseif($_GET['module']=='hubungikami'){
	echo "<span class='crumb'>Hubungi Kami</span>";
}
elseif($_GET['module']=='hubungiaksi'){
	echo "<span class='crumb'>Hubungi Kami</span>";
}
elseif($_GET['module']=='hasilcari'){
	echo "<span class='crumb'>Hasil Pencarian</span>";
}
elseif($_GET['module']=='selesaibelanja'){
	echo "<span class='crumb'>Data Pembeli</span>";
}
elseif($_GET['module']=='simpantransaksi'){
	echo "<span class='crumb'>Transaksi Selesai</span>";
}
elseif($_GET['module']=='daftar'){
	echo "<span class='crumb'>Daftar Anggota</span>";
}
elseif($_GET['module']=='profil'){
	echo "<span class='crumb'>Member Profil Anda</span>";
}
elseif($_GET['module']=='lihatorder'){
	echo "<span class='crumb'>Order Anda</span>";
}
elseif($_GET['module']=='tampilorder'){
	echo "<span class='crumb'>Konfirmasi Order</span>";
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
