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

$base_url = $_SERVER['HTTP_HOST'];
$iden=mysql_fetch_array(mysql_query("SELECT * FROM identitas"));

$aksi="modul/mod_hubungi/aksi_hubungi.php";
switch($_GET[act]){
  // Tampil hubungi
  default:
echo "<div id=main-content> 
      <div class=container_12> 
      <div class=grid_12> 
      </div>";

echo "<div class=grid_12> 
      <div class=block-border> 
      <div class=block-header> 
      <h1>Kontak Masuk</h1>
      <span></span> 
      </div> 
      <div class=block-content> 
      <table id=table-example class=table>
      <thead> 
      <tr> 
      <th>No.</th> 
      <th>Nama</th> 
      <th>Email</th> 
	  <th>Subjek</th>
	  <th>Tanggal</th>
	  <th>Aksi</th>
      </tr> 
      </thead>
	  <tbody>";


    if ($_SESSION[leveluser]=='admin'){
      $tampil = mysql_query("SELECT * FROM hubungi ORDER BY id_hubungi DESC");
    }
    else{
      $tampil=mysql_query("SELECT * FROM hubungi 
                           WHERE username='$_SESSION[namauser]'       
                           ORDER BY id_hubungi DESC");
    }
  
    $no = $posisi+1;
    while($r=mysql_fetch_array($tampil)){
      $tgl=tgl_indo($r[tanggal]);
	  if($r[dibaca]=='N'){
echo "<tr class=gradeX> 
      <td><b>$no</b></td>
	  <td><b>$r[nama]</b></td>
	  <td><b><a href=?module=hubungi&act=balasemail&id=$r[id_hubungi]>$r[email]</a></b></td>
	  <td><b>$r[subjek]</b></td>
	  <td><b>$tgl</a></b></td>
      <td class=center><a href='?module=hubungi&act=balasemail&id=$r[id_hubungi]' title='Edit' class='with-tip'><img src='img/icons/packs/fugue/16x16/icn_baca.png'  height='16' width='16'></a> 
	  <a href='$aksi?module=hubungi&act=hapus&id=$r[id_hubungi]' title='Hapus' class='with-tip' onClick=\"return confirm('Anda yakin menu ini akan dihapus?');\"><img src='img/icons/packs/fugue/16x16/cross-circle.png'  height='16' width='16'></a>
	  </td></tr>";
	  } 
	  else {
echo "<tr class=gradeX> 
      <td>$no</td>
	  <td>$r[nama]</td>
	  <td><a href=?module=hubungi&act=balasemail&id=$r[id_hubungi]>$r[email]</a></td>
	  <td>$r[subjek]</td>
	  <td>$tgl</a></td>
      <td class=center><a href='?module=hubungi&act=balasemail&id=$r[id_hubungi]' title='Edit' class='with-tip'><img src='img/icons/packs/fugue/16x16/icn_baca.png'  height='16' width='16'></a> 
	  <a href='$aksi?module=hubungi&act=hapus&id=$r[id_hubungi]' title='Hapus' class='with-tip' onClick=\"return confirm('Anda yakin menu ini akan dihapus?');\"><img src='img/icons/packs/fugue/16x16/cross-circle.png'  height='16' width='16'></a>
	  </td></tr>";
	  }
      $no++;
      }
echo "</tbody></table> ";

      break;   
  
  
case "balasemail":
    $tampil = mysql_query("SELECT * FROM hubungi WHERE id_hubungi='$_GET[id]'");
    $r      = mysql_fetch_array($tampil);
	mysql_query("UPDATE hubungi SET dibaca='Y' WHERE id_hubungi='$_GET[id]'");

echo "<div id=main-content> 
      <div class=container_12>
      <div class=grid_12> 
      <div class=block-border> 
      <div class=block-header> 
      <h1>Balas Email</h1>
      <span></span> 
      </div> 
      <div class=block-content> 
	  <form method=POST action='?module=hubungi&act=kirimemail' enctype='multipart/form-data'>
	  <p class=inline-small-label> 
      <label for=field4>Kepada</label>
	  <input type=text name='email' size=50 value='$r[email]'>
      </p>
	  
	  <p class=inline-small-label> 
      <label for=field4>Subjek</label>
	  <input type=text name='subjek' size=50 value='Re: $r[subjek]'>
      </p>
	  
	  <p class=inline-small-label> 
	  <span class=label>Pesan</span>
	  <textarea name='pesan'  style='width: 650px; height: 350px;'>
	   
	  <br><br><br><br>     
  -----------------------------------------------------------------------------------------------------------------
      $r[pesan]</textarea></p>
      <div class=block-actions> 
      <ul class=actions-right> 
      <li>
      <a class='button red' id=reset-validate-form href='?module=hubungi'>Batal</a>
      </li> </ul>
      <ul class=actions-left> 
      <li>
      <input type='submit' class='button' value='Kirim'></li> </ul> </div> 
	  </form>";
	  
     break;
    
  case "kirimemail":
    mail($_POST[email],$_POST[subjek],$_POST[pesan],"From: $iden[email]");
    echo "<div id=main-content> 
      <div class=container_12>
      <div class=grid_12> 
      <div class=block-border> 
      <div class=block-header> 
      <h1>Status Email</h1>
      <span></span> 
      </div> 
      <div class=block-content> 
          <p>Email telah sukses terkirim ke tujuan</p>
          <p>[ <a href=javascript:history.go(-2)>Kembali</a> ]</p>";	 		  
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
