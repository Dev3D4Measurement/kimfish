<?php    
session_start();
//Deteksi hanya bisa diinclude, tidak bisa langsung dibuka (direct open)
if(count(get_included_files())==1)
{
	echo "<meta http-equiv='refresh' content='0; url=http://$_SERVER[HTTP_HOST]'>";
	exit("Direct access not permitted.");
}
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{

//cek hak akses user
$cek=user_akses($_GET[module],$_SESSION[sessid]);
if($cek==1 OR $_SESSION[leveluser]=='admin'){

$aksi="modul/mod_ongkoskirim/aksi_ongkoskirim.php";
switch($_GET[act]){
  // Tampil ongkoskirim
  default:
echo "<div id=main-content> 
      <div class=container_12> 
      <div class=grid_12> 
      <br/>
	  <a href='?module=ongkoskirim&act=tambahongkoskirim' class='button'>
	  <span>Tambah Ongkos Kirim<img src='images/plus-small.gif' width='12' height='9'/></span>
      </a></div>";

echo "<div class=grid_12> 
      <div class=block-border> 
      <div class=block-header> 
      <h1>Ongkos Kirim</h1>
      <span></span> 
      </div> 
      <div class=block-content> 
      <table id=table-example class=table>
      <thead> 
      <tr> 
      <th>No</th>
	  <th>Nama Kota</th>
	  <th>Nama Propinsi</th>
	  <th>Jasa Pengiriman</th>
	  <th>Ongkos Kirim</th>
	  <th>Aksi</th>
      </tr> 
      </thead>
	  <tbody>";


    if ($_SESSION[leveluser]=='admin'){
     $tampil=mysql_query("SELECT * FROM propinsi p,kota k, ongkos_kirim o, jasa_kirim j 
                              WHERE p.id_propinsi=k.id_propinsi
                              AND k.id_kota=o.id_kota
                              AND j.id_jasa=o.id_jasa                             
                              ORDER BY k.nama_kota,o.id_ongkir DESC");
     }
     else{
     $tampil=mysql_query("SELECT * FROM propinsi p,kota k, ongkos_kirim o, jasa_kirim j 
                              WHERE p.id_propinsi=k.id_propinsi
                              AND k.id_kota=o.id_kota
                              AND j.id_jasa=o.id_jasa   
							  AND username='$_SESSION[namauser]'                          
                              ORDER BY k.nama_kota,o.id_ongkir DESC");
	 }
   
     $no=1+$posisi;
     while ($r=mysql_fetch_array($tampil)){
     $ongkos = format_rupiah($r[biaya]);
echo "<tr class=gradeX> 
      <td>$no</td> 
      <td>$r[nama_kota]</td>
	  <td>$r[nama_propinsi]</td>
	  <td>$r[nama_jasa]</td>
      <td>$ongkos</td>
      <td class=center><a href=?module=ongkoskirim&act=editongkoskirim&id=$r[id_ongkir] title='Edit' class='with-tip'><img src='img/icons/packs/fugue/16x16/tick-circle.png'  height='16' width='16'></a> 
				<a href='$aksi?module=ongkoskirim&act=hapus&id=$r[id_ongkir]&namafile=$r[gambar]' title='Hapus' class='with-tip' onClick=\"return confirm('Anda yakin menu ini akan dihapus?');\"><img src='img/icons/packs/fugue/16x16/cross-circle.png'  height='16' width='16'></a></td> 
      </tr>  
      ";
      $no++;
      }
echo "</tbody></table> ";

      break;        
  
  
case "tambahongkoskirim":
echo "<div id=main-content> 
      <div class=container_12>
      <div class=grid_12> 
      <div class=block-border> 
      <div class=block-header> 
      <h1>Tambah Ongkos Kirim</h1>
      <span></span> 
      </div> 
      <div class=block-content> 
	  <form method=POST action='$aksi?module=ongkoskirim&act=input' enctype='multipart/form-data'>
	  
      <p class=inline-small-label> 
      <span class=label>Nama Kota</span>
	  <select name='kota'>
	  <option value=0 selected>- Pilih Kota -</option>";
	  $tampil=mysql_query("SELECT * FROM kota ORDER BY nama_kota");
      while($r=mysql_fetch_array($tampil)){
echo "<option value=$r[id_kota]>$r[nama_kota]</option>";
		}
echo "</select></p>

      <p class=inline-small-label> 
      <span class=label>Jasa Pengiriman</span>
	  <select name='jasa'>
	  <option value=0 selected>- Pilih jasa pengiriman -</option>";
	  $tampil=mysql_query("SELECT * FROM jasa_kirim ORDER BY nama_jasa");
      while($r=mysql_fetch_array($tampil)){
echo "<option value=$r[id_jasa]>$r[nama_jasa]</option>";
		}
echo "</select></p>";
      
echo " <p class=inline-small-label> 
      <label for=field4>Ongkos Kirim</label>
	  <input type=text name='biaya'>
      </p> ";
    
echo "<div class=block-actions> 
      <ul class=actions-right> 
      <li>
      <a class='button red' id=reset-validate-form href='?module=ongkoskirim'>Batal</a>
      </li> </ul>
      <ul class=actions-left> 
      <li>
      <input type='submit' name='upload' class='button' value='Simpan'></li> </ul> </div> 
	  </form>";
	
	 
	 break;
 
    
  case "editongkoskirim":
   $edit=mysql_query("SELECT * FROM kota k, jasa_kirim j, ongkos_kirim o 
                      WHERE k.id_kota=o.id_kota 
                      AND j.id_jasa=o.id_jasa 
                      AND o.id_ongkir='$_GET[id]'");
    $r    = mysql_fetch_array($edit);

echo "<div id=main-content> 
      <div class=container_12>
      <div class=grid_12> 
      <div class=block-border> 
      <div class=block-header> 
      <h1>Edit Ongkos Kirim</h1>
      <span></span> 
      </div> 
      <div class=block-content>  
	  <form method=POST enctype='multipart/form-data' action=$aksi?module=ongkoskirim&act=update>
	  <input type=hidden name=id value=$r[id_ongkir]>
	  
      <p class=inline-small-label> 
      <span class=label>Nama Kota</span>
	  <select name='kota'>";
      $tampil=mysql_query("SELECT * FROM kota ORDER BY nama_kota");
      if ($r[id_kota]==0){
echo "<option value=0 selected>- Pilih Kota -</option>";
      }   
      while($w=mysql_fetch_array($tampil)){
      if ($r[id_kota]==$w[id_kota]){
echo "<option value=$w[id_kota] selected>$w[nama_kota]</option>";
      }
      else{
echo "<option value=$w[id_kota]>$w[nama_kota]</option>";
      }
      }

echo "</select></p>";

echo "<p class=inline-small-label> 
      <span class=label>Jasa Pengiriman</span>
	  <select name='jasa'>";
      $tampil=mysql_query("SELECT * FROM jasa_kirim ORDER BY nama_jasa");
      if ($r[id_jasa]==0){
echo "<option value=0 selected>- Pilih jasa pengiriman -</option>";
      }   
      while($w=mysql_fetch_array($tampil)){
      if ($r[id_jasa]==$w[id_jasa]){
echo "<option value=$w[id_jasa] selected>$w[nama_jasa]</option>";
      }
      else{
echo "<option value=$w[id_jasa]>$w[nama_jasa]</option>";
      }
      }

echo "</select></p>";

echo "<p class=inline-small-label> 
      <label for=field4>Ongkos Kirim</label>
	  <input type=text name='biaya' size=20 value='$r[biaya]'>
      </p>";
 
echo "<div class=block-actions> 
      <ul class=actions-right> 
      <li>
      <a class='button red' type=button id=reset-validate-form href='?module=ongkoskirim'>Batal</a>
      </li> 
	  </ul>
      <ul class=actions-left> 
      <li>
      <input type='submit' name='update' class='button' value='Simpan'></li> </ul> </div> 
	  </form>";
	
    break;  
   }
   //kurawal akhir hak akses module
   } else {
	echo akses_salah();
   }
   }
   ?>
</div> 
</div>
 </div>
  <div class='clear height-fix'></div> 
  </div></div>
