<?php
echo "<div class='AWlogo'>";
	  $logo=mysql_query("SELECT * FROM logo ORDER BY id_logo");
      while($b=mysql_fetch_array($logo)){
echo "<a href='index.php' class='logo'>
      <img src='aw_logo/$b[gambar]' width='245' height='70' alt='logo'/>                    
	  </a>
   	  </div>";
	  }
	  
/////////////////////////////////////////////////////////////////////////////////////////////////////////

echo "<div class='AWkategori'>
	  <h2>Kategori Produk</h2>		
	  <ul class='accordion'>";
	  $kategori=mysql_query("select nama_kategori, kategoriproduk.id_kategori, kategori_seo,  
                         count(produk.id_kategori) as jml 
                         from kategoriproduk left join produk 
                         on produk.id_kategori=kategoriproduk.id_kategori 
                         group by nama_kategori");
						 
      while($k=mysql_fetch_array($kategori)){
      $nama_kategori=strtoupper($k[nama_kategori]);
      $id=$k[id_kategori];
echo "<li>
	  <a href='' class='opener'><span>$nama_kategori</span></a>";
	  
echo "<div class='slide'>
	  <ul>";
	  $sql   = "SELECT * FROM produk WHERE id_kategori=$id 
                ORDER BY id_produk DESC";	 
	  $hasil = mysql_query($sql);
      while($r=mysql_fetch_array($hasil)){
echo "<li><a href='produk-$r[id_produk]-$r[produk_seo].html'>$r[nama_produk]</a></li>"; 
     }
echo "</ul>

	  </div>
	  </li>";
	   }
echo "</ul>
   	  </div>";

/////////////////////////////////////////////////////////////////////////////////////////////////////////
	  
echo "<div class='AWym'>
	  <h2>Layanan Online</h2>		
	  <ul class='left_info'>";
echo "<div class='ym'>";
      $ym=mysql_query("select * from mod_ym order by id desc");
	  $no=1;
      while($t=mysql_fetch_array($ym)){
echo "<div class='ym-txt'>$t[nama] </div>
	  <div class='ym-dot'>: </div>
      <div class='img-ym'><a href='ymsgr:sendIM?$t[ym]'>
	  <img src='http://opi.yahoo.com/online?u=$t[ym]&amp;m=g&amp;t=1'></a></div><br/> ";
        $no++;
	  }
echo "</div>
	  </ul>
   	  </div>";	  

/////////////////////////////////////////////////////////////////////////////////////////////////////////
	  
echo "<div class='AWtraking'>
	  <h2>Cek Status Order</h2>
	  <div class='AWstatus'>
      <form action='cek-order.html' method='post'> 
      Masukan ID ORDER anda : <br> 
      <input type='text' name='cek'>
      <input class='simplebtn' type='submit' name='submit' value='cek'> 
      </form>
      </div>
      </div>";

/////////////////////////////////////////////////////////////////////////////////////////////////////////
	  
echo "<div class='AWproduk'>
	  <h2>Produk Terlaris</h2>
	  <div class='AWproduct_panel AWproducts_list'>
	  <div id='carouselv'>";
	  
      $sql=mysql_query("SELECT * FROM produk WHERE terlaris='Y' ORDER BY id_produk LIMIT 5");
	  while ($r=mysql_fetch_array($sql)){
	  
      $disc        = ($r[potongan]/100)*$r[harga];
      $hargadisc   = number_format(($r[harga]-$disc),0,",",".");
      $subtotal    = ($r[harga]-$disc) * $r[jumlah];
      $total       = $total + $subtotal;  
      $subtotal_rp = format_rupiah($subtotal);
      $total_rp    = format_rupiah($total);
      $harga       = format_rupiah($r[harga]);
	  if ($r[stok] >= 1 AND $r[discount]=='Y'){
	  
echo "<div class='AWproduct'>
      <h2><a href='produk-$r[id_produk]-$r[produk_seo].html'>$r[nama_produk]</a></h2>
	  <img width='44' height='42' class='sale_tag' alt='$r[potongan]%'>
	  <a href=produk-$r[id_produk]-$r[produk_seo].html><a href='aw_produk/$r[gambar]' rel='prettyPhoto[pp_gal]' 
title='$r[nama_produk]'><img src='aw_produk/$r[gambar]' border='0' height=130 width=155/></a>
      <div class='AWproduct_name'><p>Stok: $r[stok]</p></div>
      <div class='AWproduct_price'>
      <p><span class='fl strikethrough'>Rp. $harga</span>                                            
	  <div class='AWharga'>Rp. $hargadisc</div></p>
      </div>
	  <div class='AWbtn'>
	  <div class='AWbtn-beli'><a href='aksi.php?module=keranjang&act=tambah&id=$r[id_produk]'>Beli</a></div>
	  <div class='AWbtn-detail'><a href='produk-$r[id_produk]-$r[produk_seo].html'>Detail</a></div>
	  </div>
	  </div>";
	  }
	  else
	  if ($r[stok] >= 1 AND $r[discount]=='N'){
echo "<div class='AWproduct'>
      <h2><a href='produk-$r[id_produk]-$r[produk_seo].html'>$r[nama_produk]</a></h2>
	  <a href=produk-$r[id_produk]-$r[produk_seo].html><a href='aw_produk/$r[gambar]' rel='prettyPhoto[pp_gal]' 
title='$r[nama_produk]'><img src='aw_produk/$r[gambar]' border='0' height=130 width=155/></a>
      <div class='AWproduct_name'><p>Stok: $r[stok]</p></div>
      <div class='AWproduct_price'>                                           
	  <span class='fr'>Rp. $harga</span></p>
      </div>
	   <div class='AWbtn'>
	  <div class='AWbtn-beli'><a href='aksi.php?module=keranjang&act=tambah&id=$r[id_produk]'>Beli</a></div>
	  <div class='AWbtn-detail'><a href='produk-$r[id_produk]-$r[produk_seo].html'>Detail</a></div>
	  </div>
	  </div>";
	  }
	else{
echo "<div class='AWproduct'>
      <h2><a href='produk-$r[id_produk]-$r[produk_seo].html'>$r[nama_produk]</a></h2>
	  <a href=produk-$r[id_produk]-$r[produk_seo].html><a href='aw_produk/$r[gambar]' rel='prettyPhoto[pp_gal]' 
title='$r[nama_produk]'><img src='aw_produk/$r[gambar]' border='0' height=130 width=155/></a>
      <div class='AWproduct_name'><p>Stok: </p></div>
      <div class='AWproduct_price'>
      <p><span class='stok'></span>    
      </div>
	   <div class='AWbtn'>
	  <div class='AWbtn-beli'>Habis</div>
	  <div class='AWbtn-detail'><a href='produk-$r[id_produk]-$r[produk_seo].html'>Detail</a></div>
	  </div>
	  </div>";
	    }
       }  
echo "</div>
	  </div>
	  </div>";



/////////////////////////////////////////////////////////////////////////////////////////////////////////
	  
echo "<div class='AWtesti'>
	  <h2>Testimoni</h2>
	  <div id='newsticker-demo'>    
      <div class='newsticker-jcarousellite'>
      <ul>";
      $testi=mysql_query("SELECT * FROM testimoni ORDER BY id_testimoni DESC");
      while($s=mysql_fetch_array($testi)){
	  $tgl = tgl_indo($s['tanggal']);
	  
	  $pesan = strip_tags($s['pesan']); // membuat paragraf pada pesan dan mengabaikan tag html
      $pesan = substr($pesan,0,40); // ambil sebanyak 40 karakter
      $pesan = substr($pesan,0,strrpos($pesan," ")); // potong per spasi kalimat
	  
	  $grav_url = 'http://www.gravatar.com/avatar/' . md5( strtolower( trim( $s[email] ) ) ) . '?d=' . urlencode(      $default ) . '&s=' .  
      $size;;
	  
      if ($s[email]!=''){
echo "<li>
      <div class='thumbnail'>
      <img src='$grav_url' width='60' height='65'>
      </div>
      <div class='info'>
	   <a href='mailto:$s[email]' target='_blank'><b>$s[nama]</b></a>";
	   }
       else{
	  
echo "<li><div class='thumbnail'>
      <img src='$f[folder]/images/bg_user.png' width='60' height='65'>
      </div>
      <div class='info'>
       <b>$s[nama]</b>";
	    }
echo "<span class='cat'>$tgl, $s[jam]</span>";
echo "<span class='cat1'><a href='' class='tooltip' title='$s[pesan]'>$pesan ...</a></span>";
echo "</div>
      </li>"; 
	
	  }
echo "</ul>
      </div>
      </div>
      </div>";

/////////////////////////////////////////////////////////////////////////////////////////////////////////
	  
echo "<div class='AWproduk'>
	  <h2>Katalog Produk</h2>";
	  $kirim=mysql_query("SELECT * FROM download ORDER BY id_download DESC LIMIT 10");
      while($d=mysql_fetch_array($kirim)){
echo "<div class='AWdownload'><a href='downlot.php?file=$d[nama_file]'> $d[judul]</a> 
      (didownload: $d[hits]x)</div> ";	  
	  }
echo "</div>";	

/////////////////////////////////////////////////////////////////////////////////////////////////////////

echo "<div class='AWrek'>
	  <h2>Rekening Bank</h2>";
	  $bank=mysql_query("SELECT * FROM mod_bank ORDER BY id_bank ASC");
      while($b=mysql_fetch_array($bank)){
echo "<div class='img-bank'><img width=60 src='aw_banner/$b[gambar]'></div>
	  <div class='rek-bank'>$b[no_rekening] </div>
	  <div class='bank'>$b[pemilik] </div>";
			  }
echo "</div>";

echo "<div class='AWjasa'>
	  <h2>Jasa Pengiriman</h2>";
	  $jasa=mysql_query("SELECT * FROM jasa_kirim ORDER BY id_jasa ASC");
      while($b=mysql_fetch_array($jasa)){
echo "<div class='AWimg-jasa'>
      <a href='$b[link]' target='_blank'>
      <img src='aw_banner/$b[gambar]' width='95' height='40'></a>
      </div>";
	  }
echo "</div>";
echo "<div class='AWfb'>
	  <h2>Facebook </h2>";
	  $sql2 = mysql_query("select facebook from identitas LIMIT 1");
      $AWfb   = mysql_fetch_array($sql2);
echo "<div class='facebookOuter'>
      <div class='facebookInner'>
      <div class='fb-like-box'  data-width='245' data-height='340'
      data-href='$AWfb[facebook]'
      data-border-color='#ebebeb' data-show-faces='true'
      data-stream='false' data-header='false'>
  </div>         
 </div>
</div>
            
<div id='fb-root'></div>";
	 
echo "</div>";

	  ?>