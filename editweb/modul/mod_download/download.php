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

$aksi="modul/mod_download/aksi_download.php";
switch($_GET[act]){
  // Tampil download
  default:
echo "<div id=main-content> 
      <div class=container_12> 
      <div class=grid_12> 
      <br/>
	  <a href='?module=download&act=tambahdownload' class='button'>
	  <span>Tambah Download<img src='images/plus-small.gif' width='12' height='9'/></span>
      </a></div>";

echo "<div class=grid_12> 
      <div class=block-border> 
      <div class=block-header> 
      <h1>Download</h1>
      <span></span> 
      </div> 
      <div class=block-content> 
      <table id=table-example class=table>
      <thead> 
      <tr> 
      <th>No.</th> 
      <th>Judul</th> 
      <th>File</th> 
	  <th>Aksi</th>
      </tr> 
      </thead>
	  <tbody>";

    if ($_SESSION[leveluser]=='admin'){
      $tampil = mysql_query("SELECT * FROM download ORDER BY id_download DESC");
    }
    else{
      $tampil=mysql_query("SELECT * FROM download 
                           WHERE username='$_SESSION[namauser]'       
                           ORDER BY id_download DESC");
    }
  
    $no = $posisi+1;
    while($r=mysql_fetch_array($tampil)){
      $tgl_posting=tgl_indo($r[tanggal]);
echo " 
      <tr class=gradeX> 
      <td>$no</td> 
      <td>$r[judul]</td> 
      <td>$r[nama_file]</td>  
      <td class=center><a href=?module=download&act=editdownload&id=$r[id_download] title='Edit' class='with-tip'><img src='img/icons/packs/fugue/16x16/tick-circle.png'  height='16' width='16'></a> 
	  <a href='$aksi?module=download&act=hapus&id=$r[id_download]&namafile=$r[nama_file]' title='Hapus' class='with-tip' onClick=\"return confirm('Anda yakin menu ini akan dihapus?');\"><img src='img/icons/packs/fugue/16x16/cross-circle.png'  height='16' width='16'></a>
	  </td></tr>";
      $no++;
      }
echo "</tbody></table> ";

      break; 
  
  
case "tambahdownload":
echo "<div id=main-content> 
      <div class=container_12>
      <div class=grid_12> 
      <div class=block-border> 
      <div class=block-header> 
      <h1>Tambah download</h1>
      <span></span> 
      </div> 
      <div class=block-content> 
	  <form method=POST action='$aksi?module=download&act=input' enctype='multipart/form-data'>
	  <p class=inline-small-label> 
      <label for=field4>Judul</label>
	  <input id=textfield name=judul size=50 class=required type=text value=''/>
      </p> 
	  
	   <p class=inline-small-label> 
	  <span class=label>Upload</span><input type='file' name='fupload' size='30' /> </p>";

echo "<div class=block-actions> 
      <ul class=actions-right> 
      <li>
      <a class='button red' id=reset-validate-form href='?module=download'>Batal</a>
      </li> </ul>
      <ul class=actions-left> 
      <li>
      <input type='submit' name='upload' class='button' value='Upload'></li> </ul> </div> 
	  </form>";
	
	 
	 break;
 
    
case "editdownload":
    $edit = mysql_query("SELECT * FROM download WHERE id_download='$_GET[id]'");
    $r    = mysql_fetch_array($edit);

echo "<div id=main-content> 
      <div class=container_12>
      <div class=grid_12> 
      <div class=block-border> 
      <div class=block-header> 
      <h1>Edit download</h1>
      <span></span> 
      </div> 
      <div class=block-content> 
	  <form method=POST action='$aksi?module=download&act=update' enctype='multipart/form-data'>
      <input type=hidden name=id value=$r[id_download]>
	  <p class=inline-small-label> 
      <label for=field4>Judul</label>
	  <input type=text name='judul' size=50 value='$r[judul]'>
      </p> ";
 
echo "<p class=inline-small-label> 
	  <span class=label>Gambar</span>
      $r[nama_file] 
      </p>
	  
      <p class=inline-small-label> 
	  <span class=label>Upload File</span>
	  <input type='file' name='fupload' size='30' /></p>";
	  
echo "<div class=block-actions> 
      <ul class=actions-right> 
      <li>
      <a class='button red' id=reset-validate-form href='?module=download'>Batal</a>
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
