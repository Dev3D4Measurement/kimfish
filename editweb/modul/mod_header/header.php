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

$aksi="modul/mod_header/aksi_header.php";
switch($_GET[act]){
  // Tampil header
  default:
echo "<div id=main-content> 
      <div class=container_12> 
      <div class=grid_12> 
      <br/>
	  <a href='?module=header&act=tambahheader' class='button'>
	  <span>Tambah Header<img src='images/plus-small.gif' width='12' height='9'/></span>
      </a></div>";

echo "<div class=grid_12> 
      <div class=block-border> 
      <div class=block-header> 
      <h1>Banner Header</h1>
      <span></span> 
      </div> 
      <div class=block-content> 
      <table id=table-example class=table>
      <thead> 
      <tr> 
      <th>No.</th> 
      <th>Judul</th> 
      <th>Gambar</th> 
      <th>Tgl. Posting</th> 
	  <th>Aksi</th>
      </tr> 
      </thead>
	  <tbody>";


    if ($_SESSION[leveluser]=='admin'){
      $tampil = mysql_query("SELECT * FROM header ORDER BY id_header DESC");
    }
    else{
      $tampil=mysql_query("SELECT * FROM header 
                           WHERE username='$_SESSION[namauser]'       
                           ORDER BY id_header DESC");
    }
  
    $no = $posisi+1;
    while($r=mysql_fetch_array($tampil)){
	 $tgl=tgl_indo($r[tgl_posting]);
echo "<tr class=gradeX> 
      <td>$no</td> 
      <td>$r[judul]</td> 
      <td><img src='../aw_header/$r[gambar]' width='80' height='50'></td>  
	  <td>$tgl</td> 
      <td class=center>
	  <a href=?module=header&act=editheader&id=$r[id_header] title='Edit' class='with-tip'>
	  <img src='img/icons/packs/fugue/16x16/tick-circle.png'  height='16' width='16'></a> 
	  <a href='$aksi?module=header&act=hapus&id=$r[id_header]&namafile=$r[gambar]' title='Hapus' class='with-tip' onClick=\"return confirm('Anda yakin menu ini akan dihapus?');\"><img src='img/icons/packs/fugue/16x16/cross-circle.png'  height='16' width='16'></a></td> 
      </tr>  
      ";
      $no++;
      }
echo "</tbody></table> ";

      break;   
  
  
case "tambahheader":
echo "<div id=main-content> 
      <div class=container_12>
      <div class=grid_12> 
      <div class=block-border> 
      <div class=block-header> 
      <h1>Tambah Banner header</h1>
      <span></span> 
      </div> 
      <div class=block-content> 
	  <form method=POST action='$aksi?module=header&act=input' enctype='multipart/form-data'>
	  <p class=inline-small-label> 
      <label for=field4>Judul</label>
	  <input id=textfield name=judul size=50 class=required type=text value=''/>
      </p> 
	  <p class=inline-small-label> 
      <span class=label>Kategori</span>
	  <select name='kategori'>
	  <option value=0 selected>- Pilih Kategori Produk -</option>";
	  $tampil=mysql_query("SELECT * FROM kategoriproduk ORDER BY nama_kategori");
	  while($r=mysql_fetch_array($tampil)){
echo "<option value=$r[id_kategori]>$r[nama_kategori]</option>";
		}
echo "</select></p>
	   <p class=inline-small-label> 
	  <span class=label>Upload</span><input type='file' name='fupload' size='30' /> *)Ukuran gambar 716x200px </p>";

echo "<div class=block-actions> 
      <ul class=actions-right> 
      <li>
      <a class='button red' id=reset-validate-form href='?module=header'>Batal</a>
      </li> </ul>
      <ul class=actions-left> 
      <li>
      <input type='submit' name='upload' class='button' value='Simpan'></li> </ul> </div> 
	  </form>";
	
	 
	 break;
 
    
case "editheader":
    $edit = mysql_query("SELECT * FROM header WHERE id_header='$_GET[id]'");
    $r    = mysql_fetch_array($edit);

echo "<div id=main-content> 
      <div class=container_12>
      <div class=grid_12> 
      <div class=block-border> 
      <div class=block-header> 
      <h1>Edit Banner Header</h1>
      <span></span> 
      </div> 
      <div class=block-content> 
	  <form method=POST action='$aksi?module=header&act=update' enctype='multipart/form-data'>
      <input type=hidden name=id value=$r[id_header]>
	  <p class=inline-small-label> 
      <label for=field4>Judul</label>
	  <input type=text name='judul' size=50 value='$r[judul]'>
      </p> 
<p class=inline-small-label> 
      <span class=label>Kategori</span>
	  <select name='kategori'>";
 
          $tampil=mysql_query("SELECT * FROM kategoriproduk ORDER BY nama_kategori");
          if ($r[id_kategori]==0){
            echo "<option value=0 selected>- Pilih Kategori -</option>";
          }   

          while($w=mysql_fetch_array($tampil)){
            if ($r[id_kategori]==$w[id_kategori]){
              echo "<option value=$w[id_kategori] selected>$w[nama_kategori]</option>";
            }
            else{
echo "<option value=$w[id_kategori]>$w[nama_kategori]</option>";
            }
          }

echo "</select></p>";

echo "<p class=inline-small-label> 
	  <span class=label>Gambar</span>
      <img src='../aw_header/$r[gambar]' width='80' height='50'> 
        
      </p>
      <p class=inline-small-label> 
	  <span class=label>Gambar</span>
	  <input type='file' name='fupload' size='30' /> *)Ukuran gambar 716x200px</p>";

echo "<div class=block-actions> 
      <ul class=actions-right> 
      <li>
      <a class='button red' id=reset-validate-form href='?module=header'>Batal</a>
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
