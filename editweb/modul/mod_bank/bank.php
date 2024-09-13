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

$aksi="modul/mod_bank/aksi_bank.php";
switch($_GET[act]){
  // Tampil bank
  default:
echo "<div id=main-content> 
      <div class=container_12> 
      <div class=grid_12> 
      <br/>
	  <a href='?module=bank&act=tambahbank' class='button'>
	  <span>Tambah Bank<img src='images/plus-small.gif' width='12' height='9'/></span>
      </a></div>";

echo "<div class=grid_12> 
      <div class=block-border> 
      <div class=block-header> 
      <h1>Bank</h1>
      <span></span> 
      </div> 
      <div class=block-content> 
      <table id=table-example class=table>
      <thead> 
      <tr> 
      <th>No</th>
	  <th>Nama Bank</th>
	  <th>Nomor Rekening</th>
	  <th>Nama Pemilik</th>
	  <th>Aksi</th>
      </tr> 
      </thead>
	  <tbody>";


    if ($_SESSION[leveluser]=='admin'){
      $tampil = mysql_query("SELECT * FROM mod_bank ORDER BY id_bank DESC");
    }
    else{
      $tampil=mysql_query("SELECT * FROM mod_bank 
                           WHERE username='$_SESSION[namauser]'       
                           ORDER BY id_bank DESC");
    }
  
    $no = $posisi+1;
    while($r=mysql_fetch_array($tampil)){
    $tgl=tgl_indo($r[tgl_posting]);
echo "<tr class=gradeX> 
      <td>$no</td> 
      <td><img src='../aw_banner/$r[gambar]' width='80' height='50'></td>
	  <td>$r[no_rekening]</td>
	  <td>$r[pemilik]</td> 
      <td class=center><a href=?module=bank&act=editbank&id=$r[id_bank] title='Edit' class='with-tip'><img src='img/icons/packs/fugue/16x16/tick-circle.png'  height='16' width='16'></a> 
				<a href='$aksi?module=bank&act=hapus&id=$r[id_bank]&namafile=$r[gambar]' title='Hapus' class='with-tip' onClick=\"return confirm('Anda yakin menu ini akan dihapus?');\"><img src='img/icons/packs/fugue/16x16/cross-circle.png'  height='16' width='16'></a></td> 
      </tr>  
      ";
      $no++;
      }
echo "</tbody></table> ";

      break;    
  
  
case "tambahbank":
echo "<div id=main-content> 
      <div class=container_12>
      <div class=grid_12> 
      <div class=block-border> 
      <div class=block-header> 
      <h1>Tambah Bank</h1>
      <span></span> 
      </div> 
      <div class=block-content> 
	  <form method=POST action='$aksi?module=bank&act=input' enctype='multipart/form-data'>
	  <p class=inline-small-label> 
      <label for=field4>Nama Bank</label>
	  <input id=textfield name=nama_bank size=50 class=required type=text value=''/>
      </p> 
	  
	  <p class=inline-small-label> 
      <label for=field4>No. Rekening</label>
	  <input id=textfield name=no_rekening size=50 class=required type=text value=''/>
      </p> 
	  
	  <p class=inline-small-label> 
      <label for=field4>Nama Pemilik</label>
	  <input id=textfield name=pemilik size=50 class=required type=text value=''/>
      </p> 
	  
	  
	   <p class=inline-small-label> 
	  <span class=label>Upload</span><input type='file' name='fupload' size='30' /> Tipe gambar harus JPG/ JPEG </p>";

echo "<div class=block-actions> 
      <ul class=actions-right> 
      <li>
      <a class='button red' id=reset-validate-form href='?module=bank'>Batal</a>
      </li> </ul>
      <ul class=actions-left> 
      <li>
      <input type='submit' name='simpan' class='button' value='Simpan'></li> </ul> </div> 
	  </form>";
	
	 
	 break;
 
    
case "editbank":
    $edit = mysql_query("SELECT * FROM mod_bank WHERE id_bank='$_GET[id]'");
    $r    = mysql_fetch_array($edit);

echo "<div id=main-content> 
      <div class=container_12>
      <div class=grid_12> 
      <div class=block-border> 
      <div class=block-header> 
      <h1>Edit Bank</h1>
      <span></span> 
      </div> 
      <div class=block-content> 
	  <form method=POST action='$aksi?module=bank&act=update' enctype='multipart/form-data'>
      <input type=hidden name=id value=$r[id_bank]>
	  <p class=inline-small-label> 
      <label for=field4>Nama Bank</label>
	  <input type=text name='nama_bank' size=50 value='$r[nama_bank]'>
      </p> 
	  
	  <p class=inline-small-label> 
      <label for=field4>No. Rekening</label>
	  <input type=text name='no_rekening' size=50 value='$r[no_rekening]'>
      </p>
	  
	  <p class=inline-small-label> 
      <label for=field4>Nama Pemilik</label>
	  <input type=text name='pemilik' size=50 value='$r[pemilik]'>
      </p> 
	  
	  
	  <p class=inline-small-label> 
	  <span class=label>Gambar</span>";
          if ($r[gambar]!=''){
echo "<img src='../aw_banner/$r[gambar]' width='80' height='50'>";  
          }
echo "</p>
      <p class=inline-small-label> 
	  <span class=label>Gambar</span>
	  <input type='file' name='fupload' size='30' /> Tipe gambar harus JPG/ JPEG/</p>";

echo "<div class=block-actions> 
      <ul class=actions-right> 
      <li>
      <a class='button red' id=reset-validate-form href='?module=bank'>Batal</a>
      </li> </ul>
      <ul class=actions-left> 
      <li>
      <input type='submit' name='simpan' class='button' value='Simpan'></li> </ul> </div> 
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
