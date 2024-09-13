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

$aksi="modul/mod_modul/aksi_modul.php";
switch($_GET[act]){
  // Tampil modul
  default:
echo "<div id=main-content> 
      <div class=container_12> 
      <div class=grid_12> 
      <br/>
	  <a href='?module=modul&act=tambahmodul' class='button'>
	  <span>Tambah modul<img src='images/plus-small.gif' width='12' height='9'/></span>
      </a><div class=right-text>
	  *) Apabila PUBLISH = Y, maka Modul ditampilkan di halaman pengunjung. <br />
      **) Apabila AKTIF = Y, maka Modul ditampilkan di halaman administrator pada daftar menu yang berada di bagian kiri.</div></div>";

echo "<div class=grid_12> 
      <div class=block-border> 
      <div class=block-header> 
      <h1>Modul</h1>
      <span></span> 
      </div> 
      <div class=block-content> 
      <table id=table-example class=table>
      <thead> 
      <tr> 
      <th>No</th>
	  <th>Nama Modul</th>
	  <th>Link</th>
	  <th>Publish</th>
	  <th>Aktif</th>
	  <th>Status</th>
	  <th>Aksi</th>
      </tr> 
      </thead>
	  <tbody>";


    if ($_SESSION[leveluser]=='admin'){
      $tampil = mysql_query("SELECT * FROM modul ORDER BY urutan DESC");
    }
    else{
      $tampil=mysql_query("SELECT * FROM modul 
                           WHERE username='$_SESSION[namauser]'       
                           ORDER BY urutan DESC");
    }
  
    $no = $posisi+1;
    while($r=mysql_fetch_array($tampil)){
      $tgl_posting=tgl_indo($r[tanggal]);
echo "<tr class=gradeX> 
      <td>$no</td>
	  <td>$r[nama_modul]</td>
	  <td><a href=$r[link]>$r[link]</a></td>
	  <td align=center>$r[publish]</td>
	  <td align=center>$r[aktif]</td>
	  <td align=center>$r[status]</td>
      <td class=center><a href=?module=modul&act=editmodul&id=$r[id_modul] title='Edit' class='with-tip'><img src='img/icons/packs/fugue/16x16/tick-circle.png'  height='16' width='16'></a> 
				<a href='$aksi?module=modul&act=hapus&id=$r[id_modul]&namafile=$r[gambar]' title='Hapus' class='with-tip' onClick=\"return confirm('Anda yakin menu ini akan dihapus?');\"><img src='img/icons/packs/fugue/16x16/cross-circle.png'  height='16' width='16'></a></td> 
      </tr> ";
      $no++;
      }
echo "</tbody></table> ";  
	  
      break;    
  
  
case "tambahmodul":

echo "<div id=main-content> 
      <div class=container_12>
      <div class=grid_12> 
      <div class=block-border> 
      <div class=block-header> 
      <h1>Tambah Modul</h1>
      <span></span> 
      </div> 
      <div class=block-content> 
	  <form method=POST action='$aksi?module=modul&act=input' enctype='multipart/form-data'>
	  <p class=inline-small-label> 
      <label for=field4>Nama Modul</label>
	  <input id=textfield name=nama_modul size=50 class=required type=text value=''/>
      </p> 
	  
	  <p class=inline-small-label> 
      <label for=field4>Link</label>
	  <input id=textfield name=link size=50 class=required type=text value=''/>
      </p> 
	  
      <p class=inline-small-label> 
	  <span class=label>Publish</span>
	  <input type=radio name='publish' value='Y' checked>Y  
	  <input type=radio name='publish' value='N'> N
	  </p> 
	  
	  <p class=inline-small-label> 
	  <span class=label>Aktif</span>
	  <input type=radio name='aktif' value='Y' checked>Y  
	  <input type=radio name='aktif' value='N'> N
	  </p> 
	  
	   <p class=inline-small-label> 
	  <span class=label>Status</span>
	  <input type=radio name='status' value='admin' checked>Admin
	  <input type=radio name='status' value='user'> User
	  </p> 
	  
	  
	  <div class=block-actions> 
      <ul class=actions-right> 
      <li>
      <a class='button red' id=reset-validate-form href='?module=modul'>Batal</a>
      </li> </ul>
      <ul class=actions-left> 
      <li>
      <input type='submit' name='upload' class='button' value='Simpan'></li> </ul> </div> 
	  </form>";

 break;
    
  case "editmodul":
    $edit = mysql_query("SELECT * FROM modul WHERE id_modul='$_GET[id]'");
    $r    = mysql_fetch_array($edit);

echo "<div id=main-content> 
      <div class=container_12>
      <div class=grid_12> 
      <div class=block-border> 
      <div class=block-header> 
      <h1>Edit Modul</h1>
      <span></span> 
      </div> 
      <div class=block-content>  
	  <form method=POST enctype='multipart/form-data' action=$aksi?module=modul&act=update>
	  <input type=hidden name=id value=$r[id_modul]>
      <p class=inline-small-label> 
      <label for=field4>Nama Modul</label>
	  <input type=text name='nama_modul' size=60 value='$r[nama_modul]'>
      </p>
	  
	  <p class=inline-small-label> 
      <label for=field4>Link</label>
	  <input type=text name='link' size=60 value='$r[link]'>
      </p> ";

      if ($r[publish]=='Y'){
echo "<p class=inline-small-label> 
      <span class=label>Publish</span> 
	  <input type=radio name='publish' value='Y' checked>Y  
      <input type=radio name='publish' value='N'> N</p>";
	  }
      else{
echo "<p class=inline-small-label> 
	  <span class=label>Publish</span>
	  <input type=radio name='publish' value='Y'>Y  
      <input type=radio name='publish' value='N' checked>N</td></tr>";								
      }
      if ($r[aktif]=='Y'){
echo "<p class=inline-small-label> 
	  <span class=label>Aktif</span>
	  <input type=radio name='aktif' value='Y' checked>Y  
      <input type=radio name='aktif' value='N'> N</p>";
	  }
      else{
echo "<p class=inline-small-label> 
      <span class=label>Aktif</span>
	  <input type=radio name='aktif' value='Y'>Y  
      <input type=radio name='aktif' value='N' checked>N</p>";	
	  }
       if ($r[status]=='Y'){
echo "<p class=inline-small-label> 
      <span class=label>Status</span> 
	  <input type=radio name='status' value='user' checked> user  
      <input type=radio name='status' value='admin'> admin </p>";
	  }
	  else{
echo "<p class=inline-small-label> 
      <span class=label>Status</span> 
	  <input type=radio name='status' value='user'>user  
      <input type=radio name='status' value='admin' checked> admin </p>";
	  }
echo "<p class=inline-small-label> 
      <label for=field4>Posisi Modul</label>
	  <input type=text name='urutan' size=1 value='$r[urutan]'>
      </p>";
	  
echo "<div class=block-actions> 
      <ul class=actions-right> 
      <li>
      <a class='button red' type=button id=reset-validate-form href='?module=modul'>Batal</a>
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
