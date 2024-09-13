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

$aksi="modul/mod_logo/aksi_logo.php";

switch($_GET[act]){
  // Tampil logo
  default:
echo "<div id=main-content> 
      <div class=container_12> 
      <div class=grid_12> 
      <br/>
	  </div>";

echo "<div class=grid_12> 
      <div class=block-border> 
      <div class=block-header> 
      <h1>Logo</h1>
      <span></span> 
      </div> 
      <div class=block-content> 
      <table id=table-example class=table>
      <thead> 
      <tr> 
      <th>No.</th> 
      <th>Logo</th> 
	  <th>Url</th> 
	  <th>Aksi</th>
      </tr> 
      </thead>
	  <tbody>";


    if ($_SESSION[leveluser]=='admin'){
      $tampil = mysql_query("SELECT * FROM logo ORDER BY id_logo DESC");
    }
    else{
      $tampil=mysql_query("SELECT * FROM logo 
                           WHERE username='$_SESSION[namauser]'       
                           ORDER BY id_logo DESC");
    }
  
    $no = $posisi+1;
    while($r=mysql_fetch_array($tampil)){
	$tgl_posting=tgl_indo($r[tanggal]);
	
echo "<tr class=gradeX> 
      <td>$no</td> 
      <td><img src='../aw_logo/$r[gambar]' width='150' height='80'></td> 
	  <td><a href=$r[url] target=_blank>$r[url]</a></td>
      <td class=center><a href=?module=logo&act=editlogo&id=$r[id_logo] title='Edit' class='with-tip'><img src='img/icons/packs/fugue/16x16/tick-circle.png'  height='16' width='16'></a> 
				</td> 
      </tr>  
      ";
      $no++;
      }
echo "</tbody></table> ";

      break;   
  
 
case "editlogo":
    $edit = mysql_query("SELECT * FROM logo WHERE id_logo='$_GET[id]'");
    $r    = mysql_fetch_array($edit);
     
echo "<div id=main-content> 
      <div class=container_12>
      <div class=grid_12> 
      <div class=block-border> 
      <div class=block-header> 
      <h1>Edit Logo</h1>
      <span></span> 
      </div> 
      <div class=block-content> 
	  <form method=POST action='$aksi?module=logo&act=update' enctype='multipart/form-data'>
      <input type=hidden name=id value=$r[id_logo]>
	  <p class=inline-small-label> 
      <label for=field4>Url</label>
	  <input type=text name='url' size=50 value='$r[url]'>
      </p>
	  
	  <p class=inline-small-label> 
	  <span class=label>Gambar</span>";
          if ($r[gambar]!=''){
              echo "<img src='../aw_logo/$r[gambar]' width='100' height='80'>";  
          }
echo "</p>
      <p class=inline-small-label> 
	  <span class=label>Gambar</span>
	  <input type='file' name='fupload' size='30' /> Tipe gambar harus JPG/ JPEG/ PNG/ GIF</p>";

echo "<div class=block-actions> 
      <ul class=actions-right> 
      <li>
      <a class='button red' id=reset-validate-form href='?module=logo'>Batal</a>
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
