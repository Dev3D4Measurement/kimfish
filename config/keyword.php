<?php
 if (isset($_GET['id'])){
      $sql = mysql_query("select nama_produk from produk where id_produk='".$val->validasi($_GET['id'],'sql')."'");
  $j   = mysql_fetch_array($sql);
	echo "$j[nama_produk]";
}
else{
      $sql2 = mysql_query("select meta_keyword from identitas LIMIT 1");
      $j2   = mysql_fetch_array($sql2);
		  echo "$j2[meta_keyword]";
}
?>
