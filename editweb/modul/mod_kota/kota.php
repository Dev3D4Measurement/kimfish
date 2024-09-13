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

$aksi="modul/mod_kota/aksi_kota.php";
switch($_GET[act]){
  // Tampil kota
  default:
echo "<div id=main-content> 
      <div class=container_12> 
      <div class=grid_12> 
      <br/>
	  <a href='?module=kota&act=tambahkota' class='button'>
	  <span>Tambah Kota<img src='images/plus-small.gif' width='12' height='9'/></span>
      </a></div>";

echo "<div class=grid_12> 
      <div class=block-border> 
      <div class=block-header> 
      <h1>Kota</h1>
      <span></span> 
      </div> 
      <div class=block-content> 
      <table id=table-example class=table>
      <thead> 
      <tr> 
      <th>No</th>
	  <th>Nama Kota</th>
	  <th>Nama Propinsi</th>
	  <th>Aksi</th>
      </tr> 
      </thead>
	  <tbody>";


      if ($_SESSION[leveluser]=='admin'){
      $tampil=mysql_query("SELECT * FROM kota,propinsi
                         WHERE kota.id_propinsi=propinsi.id_propinsi ORDER BY id_kota ASC ");
     }
     else{
     $tampil=mysql_query("SELECT * FROM kota,propinsi
                         WHERE kota.id_propinsi=propinsi.id_propinsi 
						 AND kota.username='$_SESSION[namauser]'
	                     ORDER BY id_kota ASC ");
	 }
     $no=1+$posisi;
     while ($r=mysql_fetch_array($tampil)){
echo "<tr class=gradeX> 
      <td>$no</td> 
      <td>$r[nama_kota]</td>
	  <td>$r[nama_propinsi]</td>
      <td class=center><a href=?module=kota&act=editkota&id=$r[id_kota] title='Edit' class='with-tip'><img src='img/icons/packs/fugue/16x16/tick-circle.png'  height='16' width='16'></a> 
				<a href='$aksi?module=kota&act=hapus&id=$r[id_kota]&namafile=$r[gambar]' title='Hapus' class='with-tip' onClick=\"return confirm('Anda yakin menu ini akan dihapus?');\"><img src='img/icons/packs/fugue/16x16/cross-circle.png'  height='16' width='16'></a></td> 
      </tr>  
      ";
      $no++;
      }
echo "</tbody></table> ";

      break;   
  
  
case "tambahkota":
echo "<div id=main-content> 
      <div class=container_12>
      <div class=grid_12> 
      <div class=block-border> 
      <div class=block-header> 
      <h1>Tambah Kota</h1>
      <span></span> 
      </div> 
      <div class=block-content> 
	  <form method=POST action='$aksi?module=kota&act=input' enctype='multipart/form-data'>
      <p class=inline-small-label> 
      <label for=field4>Nama Kota</label>
	  <input type=text name='nama_kota'>
      </p>
	  	  
      <p class=inline-small-label> 
      <span class=label>Nama Propinsi</span>
	  <select name='propinsi'>
	  <option value=0 selected>- Pilih Propinsi -</option>";
	  $tampil=mysql_query("SELECT * FROM propinsi ORDER BY nama_propinsi");
            while($r=mysql_fetch_array($tampil)){
echo "<option value=$r[id_propinsi]>$r[nama_propinsi]</option>";
		}
echo "</select></p>";
echo "<div class=block-actions> 
      <ul class=actions-right> 
      <li>
      <a class='button red' id=reset-validate-form href='?module=kota'>Batal</a>
      </li> </ul>
      <ul class=actions-left> 
      <li>
      <input type='submit' name='upload' class='button' value='Simpan'></li> </ul> </div> 
	  </form>";
	
	 
	 break;
 
    
  case "editkota":
   $edit = mysql_query("SELECT * FROM kota WHERE id_kota='$_GET[id]'");
   $r    = mysql_fetch_array($edit);

echo "<div id=main-content> 
      <div class=container_12>
      <div class=grid_12> 
      <div class=block-border> 
      <div class=block-header> 
      <h1>Edit Kota</h1>
      <span></span> 
      </div> 
      <div class=block-content>  
	  <form method=POST enctype='multipart/form-data' action=$aksi?module=kota&act=update>
	  <input type=hidden name=id value=$r[id_kota]>
	  
      <p class=inline-small-label> 
      <label for=field4>Kota</label>
	  <input type=text name='nama_kota' size=20 value='$r[nama_kota]'>
      </p>
	  
      <p class=inline-small-label> 
      <span class=label>Nama Propinsi</span>
	  <select name='propinsi'>";
      $tampil=mysql_query("SELECT * FROM propinsi ORDER BY nama_propinsi");
      if ($r[id_propinsi]==0){
echo "<option value=0 selected>- Pilih Propinsi -</option>";
      }   
      while($w=mysql_fetch_array($tampil)){
      if ($r[id_propinsi]==$w[id_propinsi]){
echo "<option value=$w[id_propinsi] selected>$w[nama_propinsi]</option>";
      }
      else{
echo "<option value=$w[id_propinsi]>$w[nama_propinsi]</option>";
      }
      }

echo "</select></p>";
 
echo "<div class=block-actions> 
      <ul class=actions-right> 
      <li>
      <a class='button red' type=button id=reset-validate-form href='?module=kota'>Batal</a>
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
