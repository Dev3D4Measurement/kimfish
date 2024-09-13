<?php
   
	$sid = session_id();
	$sql = mysql_query("SELECT *, SUM(jumlah*(harga-(potongan/100)*harga)) as total,SUM(jumlah) as totaljumlah 
                    FROM orders_temp, produk 
            WHERE id_session='$sid' AND orders_temp.id_produk=produk.id_produk");
			                
	while($r=mysql_fetch_array($sql)){

    if ($r['totaljumlah'] != ""){
    $selisih=$r[total5]-$r[total];
	$totalharga=$r['total']+$selisih;
    $total_rp    = format_rupiah($r['total']);
	$harga       = format_rupiah($r['harga']);
	
echo "<div class='cart_bag'>
      <a href='#' rel='toggle[cart_bag_sec]' id='manageMyAccount' class='cartbtn'>$r[totaljumlah] Produk Item -&nbsp; Rp. $total_rp</a>
	 <div id='cart_bag_sec'>
	 <div class='carttop'>&nbsp;</div>
	 <div class='cartcenter'>
	 <ul class='cartitem_smal heads'>
	 <li class='prods bold white'>Produk</li>
	 <li class='qty bold white'>QTY</li>
	 <li class='price bold white'>Harga</li>
	 </ul>";
	 $sql1 = mysql_query("SELECT * FROM orders_temp, produk 
			                WHERE id_session='$sid' AND orders_temp.id_produk=produk.id_produk");
	 while($r=mysql_fetch_array($sql1)){
	$disc        = ($r[potongan]/100)*$r[harga];
    $hargadisc   = number_format(($r[harga]-$disc),0,",",".");
	$harga       = format_rupiah($r[harga]);
	if ($r[stok] >= 1 AND $r[discount]=='N'){
echo "<ul class='cartitem_smal'>
     <li class='prodstxt'><a href='produk-$r[id_produk]-$r[produk_seo].html'>$r[nama_produk]</a></li>
     <li class='qty'><select name='jml[$no]' value=$r[jumlah] onChange='this.form.submit()'>";
     for ($j=1;$j <= $r[stok];$j++){
     if($j == $r[jumlah]){
echo "<option selected>$j</option>";}
     else{
echo "<option>$j</option>";}}
echo"</select>
     </li>
	 <li class='pricetxt'>Rp. $harga</li>
	 </ul>";
	 }
	else
	
	if ($r[stok] >= 1 AND $r[discount]=='Y'){
	echo "<ul class='cartitem_smal'>
     <li class='prodstxt'><a href='produk-$r[id_produk]-$r[produk_seo].html'>$r[nama_produk]</a></li>
     <li class='qty'><select name='jml[$no]' value=$r[jumlah] onChange='this.form.submit()'>";
     for ($j=1;$j <= $r[stok];$j++){
     if($j == $r[jumlah]){
echo "<option selected>$j</option>";}
     else{
echo "<option>$j</option>";}}
echo"</select>
     </li>
	 <li class='pricetxt'>Rp. $hargadisc</li>
	 </ul>";
	 }
	 }
echo"
	
	 <ul class='cartitem_smal heads'>
	 <li class='total bold white'>Total</li>
	 <li class='subprice bold white'>Rp. $total_rp</li>
	 </ul>
	 <ul class='crtbtns'>
	 <li><a href='keranjang-belanja.html' class='buttonone'><span>Keranjang Belanja</span></a></li>
	 <li><a href='selesai-belanja.html' class='buttonone'><span>Selesai Belanja</span></a></li>
	 </ul>
	 </div>
	 <div class='cartbot'>&nbsp;</div>
	 </div>
	 </div>";
	
  }
  else{
    echo "<div class='cart_bag'>
            	<a href='#' rel='toggle[cart_bag_sec]' id='manageMyAccount' class='cartbtn'>0 Produk Item Anda -&nbsp; Rp. 0</a>
              <div id='cart_bag_sec'>
                	<div class='carttop'>&nbsp;</div>
                    <div class='cartcenter'>
                        <ul class='cartitem_smal heads'>
                        	<li class='prods bold white'>PRODUK</li>
                            <li class='qty bold white'>QTY</li>
                            <li class='price bold white'>HARGA</li>
                        </ul>
						<p> keranjang belanja anda masih kosong</p>
                        <ul class='crtbtns'>
                        	<li><a href='produk.html' class='buttonone'><span>Lanjukan Belanja</span></a></li>
                            <li><a href='' class='buttonone'><span>Selesai Belanja</span></a></li>
                        </ul>
                    </div>
                    <div class='cartbot'>&nbsp;</div>
              </div>
            </div>";
  
  }
  }
?>

