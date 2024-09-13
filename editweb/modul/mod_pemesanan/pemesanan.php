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


$aksi="modul/mod_pemesanan/aksi_pemesanan.php";
switch($_GET[act]){
  // Tampil pemesanan
  default:
    $sql  = mysql_query("SELECT * FROM carapemesanan WHERE id_pemesanan");
    $r    = mysql_fetch_array($sql);
    if ($_SESSION[leveluser]=='admin'){
echo "<div id=main-content> 
      <div class=container_12>
      <div class=grid_12> 
      <div class=block-border> 
      <div class=block-header> 
      <h1>Edit Pemesanan</h1>
      <span></span> 
      </div> 
      <div class=block-content> 
	  <form method=POST action='$aksi?module=pemesanan&act=update' enctype='multipart/form-data'>
      <input type=hidden name=id value=$r[id_pemesanan]>
	  <p class=inline-small-label> 
	  <span class=label>Pemesanan</span>
	  <textarea name='pemesanan' style='width: 600px; height: 350px;'>$r[pemesanan]</textarea>
	  </p>";

echo "<div class=block-actions> 
      <ul class=actions-right> 
      <li>
      <a class='button red' id=reset-validate-form href='?module=pemesanan'>Batal</a>
      </li> </ul>
      <ul class=actions-left> 
      <li>
      <input type='submit' name='upload' class='button' value='Simpan'></li> </ul> </div> 
	  </form>";
	}
	 
     else{
	 
echo "<div id=main-content> 
      <div class=container_12>
      <div class=grid_12> 
      <div class=block-border> 
      <div class=block-header> 
      <h1>Anda tidak berhak mengakses halaman ini !</h1>
      <span></span> 
      </div> 
      <div class=block-content> ";  
	  
	  }
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
