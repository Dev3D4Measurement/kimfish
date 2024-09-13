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

$aksi="modul/mod_pengiriman/aksi_pengiriman.php";
switch($_GET[act]){
  // Tampil pengiriman
  default:
echo "<div id=main-content> 
      <div class=container_12> 
      <div class=grid_12> 
      <br/>
	  <a href='?module=pengiriman&act=tambahpengiriman' class='button'>
	  <span>Tambah Pengiriman<img src='images/plus-small.gif' width='12' height='9'/></span>
      </a></div>";

echo "<div class=grid_12> 
      <div class=block-border> 
      <div class=block-header> 
      <h1>Jasa Pengiriman</h1>
      <span></span> 
      </div> 
      <div class=block-content> 
      <table id=table-example class=table>
      <thead> 
      <tr> 
      <th>No</th>
	  <th>Nama Perusahaan</th>
	  <th>Link</th>
	  <th>Gambar</th>
	  <th>Aksi</th>
      </tr> 
      </thead>
	  <tbody>";


    if ($_SESSION[leveluser]=='admin'){
      $tampil = mysql_query("SELECT * FROM jasa_kirim ORDER BY id_jasa DESC");
    }
    else{
      $tampil=mysql_query("SELECT * FROM jasa_kirim 
                           WHERE username='$_SESSION[namauser]'       
                           ORDER BY id_jasa DESC");
    }
  
    $no = $posisi+1;
    while($r=mysql_fetch_array($tampil)){
echo "<tr class=gradeX> 
      <td>$no</td> 
      <td>$r[nama_jasa]</td>
	  <td>$r[link]</td>
	  <td><img src='../aw_banner/$r[gambar]' width='90' height='40'></td>
      <td class=center><a href=?module=pengiriman&act=editpengiriman&id=$r[id_jasa] title='Edit' class='with-tip'><img src='img/icons/packs/fugue/16x16/tick-circle.png'  height='16' width='16'></a> 
				<a href='$aksi?module=pengiriman&act=hapus&id=$r[id_jasa]&namafile=$r[gambar]' title='Hapus' class='with-tip' onClick=\"return confirm('Anda yakin menu ini akan dihapus?');\"><img src='img/icons/packs/fugue/16x16/cross-circle.png'  height='16' width='16'></a></td> 
      </tr>  
      ";
      $no++;
      }
echo "</tbody></table> ";

      break;    
  
  
case "tambahpengiriman":
echo "<div id=main-content> 
      <div class=container_12>
      <div class=grid_12> 
      <div class=block-border> 
      <div class=block-header> 
      <h1>Tambah Jasa Pengiriman</h1>
      <span></span> 
      </div> 
      <div class=block-content> 
	  <form method=POST action='$aksi?module=pengiriman&act=input' enctype='multipart/form-data'>
	  <p class=inline-small-label> 
      <label for=field4>Nama perusahaan</label>
	  <input id=textfield name=nama_jasa size=50 class=required type=text value=''/>
      </p> 
	  
	  <p class=inline-small-label> 
      <label for=field4>Link</label>
	  <input id=textfield name=link size=50 class=required type=text value=''/>
      </p> 
	  
	   <p class=inline-small-label> 
	  <span class=label>Upload</span><input type='file' name='fupload' size='30' /> Tipe gambar harus JPG/ JPEG</p>";

echo "<div class=block-actions> 
      <ul class=actions-right> 
      <li>
      <a class='button red' id=reset-validate-form href='?module=pengiriman'>Batal</a>
      </li> </ul>
      <ul class=actions-left> 
      <li>
      <input type='submit' name='simpan' class='button' value='Simpan'></li> </ul> </div> 
	  </form>";
	
	 
	 break;
 
    
case "editpengiriman":
    $edit = mysql_query("SELECT * FROM jasa_kirim WHERE id_jasa='$_GET[id]'");
    $r    = mysql_fetch_array($edit);

echo "<div id=main-content> 
      <div class=container_12>
      <div class=grid_12> 
      <div class=block-border> 
      <div class=block-header> 
      <h1>Edit Jasa Pengiriman</h1>
      <span></span> 
      </div> 
      <div class=block-content> 
	  <form method=POST action='$aksi?module=pengiriman&act=update' enctype='multipart/form-data'>
      <input type=hidden name=id value=$r[id_jasa]>
	  <p class=inline-small-label> 
      <label for=field4>Nama Perusahaan</label>
	  <input type=text name='nama_jasa' size=50 value='$r[nama_jasa]'>
      </p> 
	  
	  <p class=inline-small-label> 
      <label for=field4>Link</label>
	  <input type=text name='link' size=50 value='$r[link]'>
      </p> 
	  
	  <p class=inline-small-label> 
	  <span class=label>Gambar</span>";
          if ($r[gambar]!=''){
              echo "<img src='../aw_banner/$r[gambar]' width='90' height='40'>";  
          }
echo "</p>
      <p class=inline-small-label> 
	  <span class=label>Gambar</span>
	  <input type='file' name='fupload' size='30' /> Tipe gambar harus JPG/ JPEG</p>";

echo "<div class=block-actions> 
      <ul class=actions-right> 
      <li>
      <a class='button red' id=reset-validate-form href='?module=pengiriman'>Batal</a>
      </li> </ul>
      <ul class=actions-left> 
      <li>
      <input type='submit' name='upload' class='button' value='Simpan'></li> </ul> </div> 
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
