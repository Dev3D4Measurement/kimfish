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

$aksi="modul/mod_identitas/aksi_identitas.php";
switch($_GET[act]){
  // Tampil identitas
  default:
      $sql  = mysql_query("SELECT * FROM identitas LIMIT 1");
      $r    = mysql_fetch_array($sql);
	  
echo "<div id=main-content> 
      <div class=container_12>
      <div class=grid_12> 
      <div class=block-border> 
      <div class=block-header> 
      <h1>Identitas Website</h1>
      <span></span> 
      </div> 
      <div class=block-content> 
	  <form method=POST action='$aksi?module=identitas&act=update' enctype='multipart/form-data'>
      <input type=hidden name=id value=$r[id_identitas]>
	  
	  <p class=inline-small-label> 
      <label for=field4>Nama Website</label>
	  <input type=text name='nama_website' size=50 value='$r[nama_website]'>
      </p> 
	  
	  <p class=inline-small-label> 
      <label for=field4>Meta Deskripsi</label>
	  <input type=text name='meta_deskripsi' size=50 value='$r[meta_deskripsi]'>
      </p> 
	  
	  <p class=inline-small-label> 
      <label for=field4>Meta Keyword</label>
	  <input type=text name='meta_keyword' size=50 value='$r[meta_keyword]'>
      </p>
	  
	   <p class=inline-small-label> 
      <label for=field4>Email</label>
	  <input type=text name='email' size=50 value='$r[email]'>
      </p>
	  
	   <p class=inline-small-label> 
      <label for=field4>Telepon</label>
	  <input type=text name='tlp' size=50 value='$r[tlp]'>
      </p>
	  
	  <p class=inline-small-label> 
      <label for=field4>Url</label>
	  <input type=text name='url' size=50 value='$r[url]'><br/>
	  *) Apabila di-onlinekan di web hosting, ganti URL dengan URL website anda. <br/>
	  contoh: <span class style=\"color:#EA1C1C;\">http://cvseamalaka.com</span>
      </p>
	  
	  <p class=inline-small-label> 
      <label for=field4>Facebook Pages</label>
	  <input type=text name='facebook' size=50 value='$r[facebook]'><br/>
	  *) contoh: https://www.facebook.com/pages/cvseamalaka/239333572825499
      </p>
	  
	   <p class=inline-small-label> 
	  <span class=label>Alamat</span>
	  <textarea name='alamat' style='width: 600px; height: 350px;'>$r[alamat]</textarea>
	  </p>
	  
	  <p class=inline-small-label> 
	  <span class=label>Gambar Favicon</span>";
          if ($r[favicon]!=''){
              echo "<img src='../aw_logo/$r[favicon]'>";  
          }
echo "</p>
      <p class=inline-small-label> 
	  <span class=label>Ganti Favicon</span>
	  <input type='file' name='fupload' size='30' /> Tipe gambar harus JPG/ JPEG/ PNG/ GIF</p>";

echo "<div class=block-actions> 
      <ul class=actions-right> 
      <li>
      <a class='button red' id=reset-validate-form href='?module=identitas'>Batal</a>
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
