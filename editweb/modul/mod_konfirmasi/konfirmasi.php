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

$aksi="modul/mod_konfirmasi/aksi_konfirmasi.php";
switch($_GET[act]){
  // Tampil konfirmasi
  default:
echo "<div id=main-content> 
      <div class=container_12> 
      <div class=grid_12> 
      </div>";

echo "<div class=grid_12> 
      <div class=block-border> 
      <div class=block-header> 
      <h1>Konfirmasi Pembayaran</h1>
      <span></span> 
      </div> 
      <div class=block-content> 
      <table id=table-example class=table>
      <thead> 
      <tr> 
      <th>No. Order</th>
	  <th>Nama</th>
	  <th>Rekening</th>
	  <th>Transfer Bank</th>
	  <th>Email</th>
	  <th>Aksi</th>
      </tr> 
      </thead>
	  <tbody>";

    if ($_SESSION[leveluser]=='admin'){
      $tampil=mysql_query("SELECT * FROM konfirmasi,mod_bank WHERE konfirmasi.id_bank=mod_bank.id_bank ORDER BY mod_bank.nama_bank,konfirmasi.id_konfirmasi DESC");
    }
    else{
      $tampil=mysql_query("SELECT * FROM konfirmasi, mod_bank 
                           WHERE username='$_SESSION[namauser]'       
                           ORDER BY id_konfirmasi DESC");
    }
  
    $no = $posisi+1;
    while($r=mysql_fetch_array($tampil)){
      $tgl=tgl_indo($r[tanggal]);
	  if($r[dibaca]=='N'){
echo "<tr class=gradeX> 
      <td><b>$r[noorder]</b></td>
	  <td><b>$r[namalengkap]</b></td>
	  <td><b>$r[norekening]</b></td>
	  <td><b>$r[nama_bank] <br/>sebesar $r[jmlhpembayaran]</b></td>
	  <td><b>$r[email]</b></td>
      <td class=center><a href='?module=konfirmasi&act=balasemail&id=$r[id_konfirmasi]' title='Edit' class='with-tip'><img src='img/icons/packs/fugue/16x16/icn_baca.png'  height='16' width='16'></a> 
	  <a href='$aksi?module=konfirmasi&act=hapus&id=$r[id_konfirmasi]' title='Hapus' class='with-tip' onClick=\"return confirm('Anda yakin menu ini akan dihapus?');\"><img src='img/icons/packs/fugue/16x16/cross-circle.png'  height='16' width='16'></a>
	  </td></tr>";
	  } 
	  else {
echo "<tr class=gradeX> 
      <td>$r[noorder]</td>
	  <td>$r[namalengkap]</td>
	  <td>$r[norekening]</td>
	  <td>$r[nama_bank] <br/>sebesar $r[jmlhpembayaran]</td>
	  <td>$r[email]</td>
      <td class=center><a href='?module=konfirmasi&act=balasemail&id=$r[id_konfirmasi]' title='Edit' class='with-tip'><img src='img/icons/packs/fugue/16x16/icn_baca.png'  height='16' width='16'></a> 
	  <a href='$aksi?module=konfirmasi&act=hapus&id=$r[id_konfirmasi]' title='Hapus' class='with-tip' onClick=\"return confirm('Anda yakin menu ini akan dihapus?');\"><img src='img/icons/packs/fugue/16x16/cross-circle.png'  height='16' width='16'></a>
	  </td></tr>";
	  }
      $no++;
      }
echo "</tbody></table> ";

      break; 
  
  
case "balasemail":
   $tampil = mysql_query("SELECT * FROM konfirmasi,mod_bank WHERE konfirmasi.id_bank=mod_bank.id_bank ORDER BY mod_bank.nama_bank,konfirmasi.id_konfirmasi DESC");
    $r      = mysql_fetch_array($tampil);
	mysql_query("UPDATE konfirmasi SET dibaca='Y' WHERE id_konfirmasi='$_GET[id]'");

echo "<div id=main-content> 
      <div class=container_12>
      <div class=grid_12> 
      <div class=block-border> 
      <div class=block-header> 
      <h1>Data Konfirmasi Pembayaran Kustemer</h1>
      <span></span> 
      </div> 
	  <div class=block-content1> 
	  <form method=POST action=''>
	  <table id=table-example class=table>
	  <tbody>
	  <tr><td>Nama Lengkap</td><td>$r[namalengkap]</td></tr>
	  <tr><td>Email</td><td>$r[email]</td></tr>
	  <tr><td>No. Order</td><td>$r[noorder]</td></tr>
	  <tr><td>Tanggal Pembayaran</td><td>$r[tglpembayaran] / $r[jam]</td></tr>
	  <tr><td>Jumlah Pembayaran</td><td>$r[jmlhpembayaran]</td></tr>
	  <tr><td>Bank Tujuan</td><td>$r[nama_bank]</td></tr>
	  <tr><td>Nama Rekening</td><td>$r[namarekening]</td></tr>
	  <tr><td>No. Rekening</td><td>$r[norekening]</td></tr>
	  <tr><td>Pesan</td><td>$r[pesan]</td></tr>
	  </tbody></table>
	  </form>";
			
echo "<div class=block-header>
	  <h1>Kirim Email ke Kustemer</h1>
      <span></span>
      </div>
      <form method=POST action='?module=konfirmasi&act=kirimemail' enctype='multipart/form-data'>
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
      <textarea name='pesan'  style='width: 650px; height: 350px;'><br/><br/><br/><br/>  
  ----------------------------------------------------------------------------------------------------------------------
      $r[pesan]</textarea></p>
	  <div class=block-actions1> 
      <ul class=actions1-right> 
      <li>
      <a class='button red' id=reset-validate-form  onclick=\"location.href='?module=konfirmasi'\">Batal</a>
      </li> </ul>
      <ul class=actions1-left> 
      <li>
      <input type='submit' name='upload' class='button' value='Kirim'></li> </ul> </div> 
	  </form>";
      break;
    
     case "kirimemail":
mail($_POST[email],$_POST[subjek],$_POST[pesan],"From: $iden[email]");
echo "<form method=POST action='?module=konfirmasi&act=kirimemail' enctype='multipart/form-data'>
      div id=main-content> 
      <div class=container_12>
      <div class=grid_12> 
      <div class=block-border> 
      <div class=block-header> 
      <h1>Status Konfirmasi Pembayaran</h1>
      <span></span> 
      </div> 
      <div class=block-content> 
	  <form method=POST action='' enctype='multipart/form-data'>
      <p>Email Konfirmasi telah sukses terkirim ke tujuan
          [ <a href=javascript:history.go(-2)>Kembali</a> ]</p></div></form>";	 		  
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
