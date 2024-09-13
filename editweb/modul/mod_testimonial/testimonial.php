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

$aksi="modul/mod_testimonial/aksi_testimonial.php";
switch($_GET[act]){
  // Tampil testimoni
  default:
echo "<div id=main-content> 
      <div class=container_12> 
      <div class=grid_12> 
      </div>";

echo "<div class=grid_12> 
      <div class=block-border> 
      <div class=block-header> 
      <h1>Testimonial</h1>
      <span></span> 
      </div> 
      <div class=block-content> 
      <table id=table-example class=table>
      <thead> 
      <tr> 
      <th>No</th>
	  <th>Nama</th>
	  <th>Email</th>
	  <th>Pesan</th>
	  <th>Tanggal</th>
	  <th>Aksi</th>
      </tr> 
      </thead>
	  <tbody>";
	  
    if ($_SESSION[leveluser]=='admin'){
      $tampil = mysql_query("SELECT * FROM testimoni ORDER BY id_testimoni DESC");
    }
    else{
      $tampil=mysql_query("SELECT * FROM testimoni 
                           WHERE username='$_SESSION[namauser]'       
                           ORDER BY id_testimoni DESC");
    }
  
    $no = $posisi+1;
    while($r=mysql_fetch_array($tampil)){
      $tgl=tgl_indo($r[tanggal]);
echo "<tr class=gradeX> 
      <td>$no</td>
	  <td>$r[nama]</td>
	  <td>$r[email]</td>
	  <td>$r[pesan]</td>
	  <td>$tgl</a></td>
      <td class=center>
	  <a href='$aksi?module=testimonial&act=hapus&id=$r[id_testimoni]' title='Hapus' class='with-tip' onClick=\"return confirm('Anda yakin menu ini akan dihapus?');\"><img src='img/icons/packs/fugue/16x16/cross-circle.png'  height='16' width='16'></a>
	  </td></tr>";
      $no++;
      }
echo "</tbody></table> ";

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
