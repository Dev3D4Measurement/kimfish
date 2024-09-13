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

$aksi="modul/mod_poling/aksi_poling.php";
switch($_GET[act]){
  // Tampil poling
  default:
echo "<div id=main-content> 
      <div class=container_12> 
      <div class=grid_12> 
      <br/>
	  <a href='?module=poling&act=tambahpoling' class='button'>
	  <span>Tambah Poling<img src='images/plus-small.gif' width='12' height='9'/></span>
      </a></div>";

echo "<div class=grid_12> 
      <div class=block-border> 
      <div class=block-header> 
      <h1>Poling</h1>
      <span></span> 
      </div> 
      <div class=block-content> 
      <table id=table-example class=table>
      <thead> 
      <tr> 
      <th>No.</th> 
      <th>Pilihan</th> 
      <th>Status</th> 
      <th>Rating</th> 
      <th>Aktif</th> 
	  <th>Aksi</th>
      </tr> 
      </thead>
	  <tbody>";

    if ($_SESSION[leveluser]=='admin'){
      $tampil = mysql_query("SELECT * FROM poling ORDER BY id_poling DESC");
    }
    else{
      $tampil=mysql_query("SELECT * FROM poling 
                           WHERE username='$_SESSION[namauser]'       
                           ORDER BY id_poling DESC");
    }
  
    $no = $posisi+1;
    while($r=mysql_fetch_array($tampil)){
echo "<tr class=gradeX> 
      <td>$no</td>
	  <td>$r[pilihan]</td>
	  <td>$r[status]</td>
	  <td>$r[rating]</td>
	  <td>$r[aktif]</td>
      <td class=center><a href=?module=poling&act=editpoling&id=$r[id_poling] title='Edit' class='with-tip'><img src='img/icons/packs/fugue/16x16/tick-circle.png'  height='16' width='16'></a> 
				<a href='$aksi?module=poling&act=hapus&id=$r[id_poling]' title='Hapus' class='with-tip' onClick=\"return confirm('Anda yakin menu ini akan dihapus?');\"><img src='img/icons/packs/fugue/16x16/cross-circle.png'  height='16' width='16'></a></td> 
      </tr>  
      ";
      $no++;
      }
echo "</tbody></table> ";
      break;  
     
  
  
case "tambahpoling":
echo "<div id=main-content> 
      <div class=container_12>
      <div class=grid_12> 
      <div class=block-border> 
      <div class=block-header> 
      <h1>Tambah Poling</h1>
      <span></span> 
      </div> 
      <div class=block-content> 
	  <form method=POST action='$aksi?module=poling&act=input' enctype='multipart/form-data'>
	  <p class=inline-small-label> 
      <label for=field4>Pilihan</label>
	  <input id=textfield name=pilihan size=50 class=required type=text value=''/>
      </p> 
	  
      <p class=inline-small-label> 
      <span class=label>Status</span>     
	  <input type=radio name='status' value='jawaban' checked> Jawaban  
	  <input type=radio name='status' value='pertanyaan'> Pertanyaan  
	  *) Apabila poling ingin dijadikan Status Jawaban/pertanyaan, pilih Status = Y
	  </p> 
	  
	  <p class=inline-small-label> 
      <span class=label>Aktif</span>     
	  <input type=radio name='aktif' value='Y' checked>Y 
      <input type=radio name='aktif' value='N'>N  
	  *) Apabila poling ingin dijadikan Aktif, pilih Aktif = Y
	  </p> 
	 
	  <div class=block-actions> 
      <ul class=actions-right> 
      <li>
      <a class='button red' id=reset-validate-form href='?module=poling'>Batal</a>
      </li> </ul>
      <ul class=actions-left> 
      <li>
      <input type='submit' class='button' value='Simpan'></li> </ul> </div> 
	  </form>";
	
	 
	 break;
 
    
  case "editpoling":
    $edit = mysql_query("SELECT * FROM poling WHERE id_poling='$_GET[id]'");
    $r    = mysql_fetch_array($edit);

echo "<div id=main-content> 
      <div class=container_12>
      <div class=grid_12> 
      <div class=block-border> 
      <div class=block-header> 
      <h1>Edit Poling</h1>
      <span></span> 
      </div> 
      <div class=block-content>  
	  <form method=POST enctype='multipart/form-data' action=$aksi?module=poling&act=update>
	  <input type=hidden name=id value=$r[id_poling]>
      <p class=inline-small-label> 
      <label for=field4>Pilihan</label>
	  <input type=text name='pilihan' size=60 value='$r[pilihan]'>
      </p>";

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
	  if ($r[status]=='Jawaban'){
echo "<p class=inline-small-label> 
	  <span class=label>Status</span>
	  <input type=radio name='status' value='Jawaban' checked>Jawaban  
      <input type=radio name='status' value='Pertanyaan'> Pertanyaan</td></tr>";								
      }
     else{
echo "<p class=inline-small-label> 
	  <span class=label>Status</span>
	  <input type=radio name='status' value='Jawaban'>Jawaban  
      <input type=radio name='status' value='Pertanyaan' checked>Pertanyaan</p>";
      }
echo "<div class=block-actions> 
      <ul class=actions-right> 
      <li>
      <a class='button red' type=button id=reset-validate-form href='?module=poling'>Batal</a>
      </li> 
	  </ul>
      <ul class=actions-left> 
      <li>
      <input type='submit' class='button' value='Simpan'></li> </ul> </div> 
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
