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

echo "<div id=main-content> 
      <div class=container_12>
      <div class=grid_12> 
      <div class=block-border> 
      <div class=block-header> 
      <h1>Laporan Penjualan</h1>
      <span></span> 
      </div> 
      <div class=block-content> 
	  <form method=POST action='modul/mod_laporan/pdf_toko.php' enctype='multipart/form-data'>";
echo "<p class=inline-small-label> 
	  <label for=field4>Dari Tanggal</label>";        
	  combotgl(1,31,'tgl_mulai',$tgl_skrg);
	  combonamabln(1,12,'bln_mulai',$bln_sekarang);
	  combothn(2000,$thn_sekarang,'thn_mulai',$thn_sekarang);
echo "</p>"; 
echo "<p class=inline-small-label>
	  <label for=field4>s/d Tanggal</label>";
	  combotgl(1,31,'tgl_selesai',$tgl_skrg);
	  combonamabln(1,12,'bln_selesai',$bln_sekarang);
	  combothn(2000,$thn_sekarang,'thn_selesai',$thn_sekarang);

echo "</p>
	  <div class=block-actions> 
      <ul class=actions-right> 
      <li>
      <a class='button red' id=reset-validate-form href='?module=laporan'>Batal</a>
      </li> </ul>
      <ul class=actions-left> 
      <li>
      <input type='submit' name='simpan' class='button' value='Simpan'></li> </ul> </div> 
	  </form>";
// dihapus break;
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