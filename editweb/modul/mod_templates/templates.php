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

$aksi="modul/mod_templates/aksi_templates.php";
switch($_GET[act]){
  // Tampil modul
  default:
echo "<div id=main-content> 
      <div class=container_12> 
      <div class=grid_12> 
      <br/>
	  <a href='?module=templates&act=tambahtemplates' class='button'>
	  <span>Tambah Templates<img src='images/plus-small.gif' width='12' height='9'/></span>
      </a></div>";

echo "<div class=grid_12> 
      <div class=block-border> 
      <div class=block-header> 
      <h1>Templates</h1>
      <span></span> 
      </div> 
      <div class=block-content> 
      <table id=table-example class=table>
      <thead> 
      <tr> 
      <th>No.</th> 
      <th>Nama Template</th> 
	  <th>Gambar</th> 
      <th>Pembuat</th> 
	  <th>Folder</th>
	  <th>Aktif</th>
	  <th>Aksi</th>
      </tr> 
      </thead>
	  <tbody>";


    if ($_SESSION[leveluser]=='admin'){
      $tampil = mysql_query("SELECT * FROM templates ORDER BY id_templates DESC");
    }
    else{
      $tampil=mysql_query("SELECT * FROM templates
                           WHERE username='$_SESSION[namauser]'       
                           ORDER BY id_templates DESC");
    }
  
    $no = $posisi+1;
    while($r=mysql_fetch_array($tampil)){
      $tgl_posting=tgl_indo($r[tanggal]);
echo "<tr class=gradeX> 
      <td>$no</td> 
	  <td>$r[judul]</td>
	  <td><img src='../aw_templates/$r[gambar]' width='80' height='50'></td>
      <td>$r[pembuat]</td>
	  <td>$r[folder]</td>
	  <td>$r[aktif]</td>
      <td class=center><a href=?module=templates&act=edittemplates&id=$r[id_templates] title='Edit' class='with-tip'><img src='img/icons/packs/fugue/16x16/tick-circle.png'  height='16' width='16'></a> 
	  <a href=$aksi?module=templates&act=aktifkan&id=$r[id_templates] title='Aktif' class='with-tip'><img src='img/icons/packs/fugue/16x16/tick.png'  height='16' width='16'></a> </td> 
      </tr>    
      ";
      $no++;
      }
echo "</tbody></table> ";
   
      break;   
  
case "tambahtemplates":

  
echo "<div id=main-content> 
      <div class=container_12>
      <div class=grid_12> 
      <div class=block-border> 
      <div class=block-header> 
      <h1>Tambah Templates</h1>
      <span></span> 
      </div> 
      <div class=block-content> 
	  <form method=POST action='$aksi?module=templates&act=input' enctype='multipart/form-data'>
	  <p class=inline-small-label> 
      <label for=field4>Nama Template</label>
	  <input id=textfield name=judul size=50 class=required type=text value=''/>
      </p> 
	  
	  <p class=inline-small-label> 
      <label for=field4>Pembuat</label>
	  <input id=textfield name=pembuat size=50 class=required type=text value=''/>
      </p>
	  
	  <p class=inline-small-label> 
      <label for=field4>Folder</label>
	  <input id=textfield name=folder size=50 class=required type=text value='templates/'/>
      </p>
	  
	   <p class=inline-small-label> 
	  <span class=label>Upload</span><input type='file' name='fupload' size='30' /> *) Ukuran gambar max. 200px </p>";

echo "</p>
	  <div class=block-actions> 
      <ul class=actions-right> 
      <li>
      <a class='button red' id=reset-validate-form href='?module=templates'>Batal</a>
      </li> </ul>
      <ul class=actions-left> 
      <li>
      <input type='submit' name='upload' class='button' value='Simpan'></li> </ul> </div> 
	  </form>";
	
      break; 
 
    
  case "edittemplates":
    $edit = mysql_query("SELECT * FROM templates WHERE id_templates='$_GET[id]'");
    $r    = mysql_fetch_array($edit);

echo "<div id=main-content> 
      <div class=container_12>
      <div class=grid_12> 
      <div class=block-border> 
      <div class=block-header> 
      <h1>Edit Templates</h1>
      <span></span> 
      </div> 
      <div class=block-content>  
	  <form method=POST enctype='multipart/form-data' action=$aksi?module=templates&act=update>
	  <input type=hidden name=id value=$r[id_templates]>
      <p class=inline-small-label> 
      <label for=field4>Nama Template</label>
	  <input type=text name='judul' size=60 value='$r[judul]'>
      </p> 
	  
	  <p class=inline-small-label> 
      <label for=field4>Pembuat</label>
	  <input type=text name='pembuat' size=60 value='$r[pembuat]' disabled>
      </p>
	  
	  <p class=inline-small-label> 
      <label for=field4>Folder</label>
	  <input type=text name='folder' size=60 value='$r[folder]'>
      </p>";

echo "<p class=inline-small-label> 
	  <span class=label>Gambar</span>";
          if ($r[gambar]!=''){
              echo "<img src='../aw_templates/small_$r[gambar]'>";  
          }
echo "</p>
	  <p class=inline-small-label> 
	  <span class=label>Gambar</span>
	  <input type='file' name='fupload' size='30' /> *) Ukuran gambar max. 200px, Apabila tidak dirubah dikosongkan saja.</p>";

 
echo "<div class=block-actions> 
      <ul class=actions-right> 
      <li>
      <a class='button red' type=button id=reset-validate-form href='?module=templates'>Batal</a>
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
