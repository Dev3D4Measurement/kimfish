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

$aksi="modul/mod_menuutama/aksi_menuutama.php";
switch($_GET[act]){
  // Tampil Menu Utama
  default:
  
echo "<div id=main-content> 
      <div class=container_12> 
      <div class=grid_12> 
      <br/>
	  <a href='?module=menuutama&act=tambahmenuutama' class='button'>
	  <span>Tambah Menu Utama<img src='images/plus-small.gif' width='12' height='9'/></span>
      </a></div>";

echo "<div class=grid_12> 
      <div class=block-border> 
      <div class=block-header> 
      <h1>Menu Utama</h1>
      <span></span> 
      </div> 
      <div class=block-content> 
      <table id=table-example class=table>
		
   <thead><tr>
   <th>No</th>
   <th>Menu Utama</th>
   <th>Link</th>
   <th>Urutan</th>
   <th>Aktif</th>
   <th>Aksi</th>
   </thead>
   <tbody>";
    if ($_SESSION[leveluser]=='admin'){
       $tampil=mysql_query("SELECT * FROM mainmenu ORDER BY urutan DESC");
    }
    else{
      $tampil=mysql_query("SELECT * FROM mainmenu 
                           WHERE username='$_SESSION[namauser]'       
                           ORDER BY id_main DESC");
    }
  
    $no = $posisi+1;
    while ($r=mysql_fetch_array($tampil)){
				$id=$r['id_main'];
				
   //menu pengaturan posisi
	$desc=mysql_fetch_array(mysql_query("SELECT * FROM mainmenu ORDER BY urutan DESC LIMIT 1"));
	$id_order_desc = $desc['urutan'];
	if($r['urutan']<=1){
	$menu_posisi="<lable><img src='img/blank.png'>
	<a href='$aksi?module=menuutama&act=posdo&id=$r[id_main]&urutan=$r[urutan]'>
	<img src='img/up.png'></a></lable>";}
	
	elseif($r['urutan']<$id_order_desc) {
	$menu_posisi="<a href='$aksi?module=menuutama&act=posup&id=$r[id_main]&urutan=$r[urutan]'>
	<img src='img/down.png'></a><a href='$aksi?module=menuutama&act=posdo&id=$r[id_main]&urutan=$r[urutan]'>
	<img src='img/up.png'></a>";}
	
	elseif($r['urutan']>=$id_order_desc){
	$menu_posisi="<a href='$aksi?module=menuutama&act=posup&id=$r[id_main]&urutan=$r[urutan]'>
	<img src='img/down.png'></a>
	<img src='img/blank.png'>";}
	
echo "<tr class=gradeX> 
      <td>$no</td> 
 
      <td>$r[nama_menu]</td>
      <td>$r[link]</td>
   
      <td width=120 ><center><div class='_25'>
      <input id='25' size='1' type=text value='$r[urutan]' disabled></div>$menu_posisi</center></td>
	  
      <td width=50><center>$r[aktif]</center></td>
	  
       <td class=center><a href=?module=menuutama&act=editmenuutama&id=$r[id_main] title='Edit' class='with-tip'><img src='img/icons/packs/fugue/16x16/tick-circle.png'  height='16' width='16'></a> 
				</td>  
   
      </td></tr>";
	  $no++;
      }
 echo "</tbody></table> ";  
   
   
    break;
  
  
   // Form Tambah Menu Utama
   case "tambahmenuutama":
echo "<div id=main-content> 
      <div class=container_12>
      <div class=grid_12> 
      <div class=block-border> 
      <div class=block-header> 
      <h1>Tambah Menu Utama</h1>
      <span></span> 
      </div> 
      <div class=block-content> 
	  <form method=POST action='$aksi?module=menuutama&act=input' enctype='multipart/form-data'>
		  
      <p class=inline-small-label> 
      <label for=field4>Nama Menu</label>
      <input type=text name='nama_menu' size=50>
      </p> 
	 
   
      <p class=inline-small-label> 
      <label for=field4>Link</label>
      <input type=text name='link' size=50>
      </p> 		  
	  
	  <p class=inline-small-label> 
      <label for=field4>Urutan</label>
      <input name='urutan' type=text size=50 value='$r[urutan]'>
      </p>
	  
      <div class=block-actions> 
      <ul class=actions-right> 
      <li>
      <a class='button red' id=reset-validate-form href='?module=menuutama'>Batal</a>
      </li> </ul>
      <ul class=actions-left> 
      <li>
      <input type='submit' class='button' value='Simpan'></li> </ul> </div> 
	  </form>";
	 
   break;
  
   // Form Edit Menu Utama
   case "editmenuutama":
   $edit=mysql_query("SELECT * FROM mainmenu WHERE id_main='$_GET[id]'");
   $r=mysql_fetch_array($edit);

		  
echo "<div id=main-content> 
      <div class=container_12>
      <div class=grid_12> 
      <div class=block-border> 
      <div class=block-header> 
      <h1>Edit Menu Utama</h1>
      <span></span> 
      </div> 
      <div class=block-content> 
	  <form method=POST action='$aksi?module=menuutama&act=update' enctype='multipart/form-data'>
      <input type=hidden name=id value='$r[id_main]'>	  
		  
		  
      <p class=inline-small-label> 
      <label for=field4>Nama Menu</label>
      <input type=text name='nama_menu' size=50 value='$r[nama_menu]'>
      </p> 
	 
   
      <p class=inline-small-label> 
      <label for=field4>Link</label>
      <input type=text name='link' size=50 value='$r[link]'>
      </p> 
	  
	  <p class=inline-small-label> 
      <label for=field4>Urutan</label>
      <input name='urutan' type=text size=50 value='$r[urutan]'>
      </p>";
	  
    if ($r[aktif]=='Y'){
echo "<p class=inline-small-label> 
      <span class=label>Aktif</span> 
	  <input type=radio name='aktif' value='Y' checked> Y  
      <input type=radio name='aktif' value='N'> N </p>";
	  }
	  else{
echo "<p class=inline-small-label> 
      <span class=label>Aktif</span> 
	  <input type=radio name='aktif' value='Y'> Y  
      <input type=radio name='aktif' value='N' checked> N </p>";
	  }
   

echo "<div class=block-actions> 
      <ul class=actions-right> 
      <li>
      <a class='button red' id=reset-validate-form href='?module=menuutama'>Batal</a>
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


