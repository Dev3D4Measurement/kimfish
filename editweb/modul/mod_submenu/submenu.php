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

$aksi="modul/mod_submenu/aksi_submenu.php";
switch($_GET[act]){


  // Tampil Sub Menu
  default:
  
  
echo "<div id=main-content> 
      <div class=container_12> 
      <div class=grid_12> 
      <br/>
	  <a href='?module=submenu&act=tambahsubmenu' class='button'>
	  <span>Tambah Submenu<img src='images/plus-small.gif' width='12' height='9'/></span>
      </a></div>";

echo "<div class=grid_12> 
      <div class=block-border> 
      <div class=block-header> 
      <h1>Submenu</h1>
      <span></span> 
      </div> 
      <div class=block-content> 
      <table id=table-example class=table>
		
   <thead><tr>
   
   <th>No</th>
   <th>Sub Menu</th>
   <th>Menu Utama</th>
   <th>Link Submenu</th>
   <th>Aksi</th>
		  
   </thead>
   <tbody>";

	
	if ($_SESSION[leveluser]=='admin'){
      $tampil = mysql_query("SELECT * FROM submenu,mainmenu 
	                         WHERE submenu.id_main=mainmenu.id_main ORDER BY id_sub DESC");
    }
    else{
	$tampil=mysql_query("SELECT * FROM submenu,mainmenu
                         WHERE submenu.username='$_SESSION[namauser]' 
                         AND submenu.id_main=mainmenu.id_main
						 ORDER BY id_sub DESC");
    
    }
  
    $no = $posisi+1;
    while($r=mysql_fetch_array($tampil)){
  echo "<tr class=gradeX> 
  <td><center>$no</center></td>
  <td>$r[nama_sub]</td>
  <td>$r[nama_menu]</td>
  <td>$r[link_sub]</td>
  
  <td class=center><a href=?module=submenu&act=editsubmenu&id=$r[id_sub] title='Edit' class='with-tip'><img src='img/icons/packs/fugue/16x16/tick-circle.png'  height='16' width='16'></a> 
				<a href='$aksi?module=submenu&act=hapus&id=$r[id_sub]' title='Hapus' class='with-tip' onClick=\"return confirm('Anda yakin menu ini akan dihapus?');\"><img src='img/icons/packs/fugue/16x16/cross-circle.png'  height='16' width='16'></a></td></tr>";
				
   $no++;}
   
    echo "</tbody></table> ";
      break; 
  
   case "tambahsubmenu":
   
echo "<div id=main-content> 
      <div class=container_12>
      <div class=grid_12> 
      <div class=block-border> 
      <div class=block-header> 
      <h1>Tambah Submenu</h1>
      <span></span> 
      </div> 
      <div class=block-content> 
   
   
   <form method=POST action='$aksi?module=submenu&act=input'>
   
   <p class=inline-small-label> 
   <label for=field4>Sub Menu</label>
   <input type=text name='nama_sub' size=50>
   </p> 
   
   <p class=inline-small-label> 
   <label for=field4>Menu Utama</label>
   <select name='menu_utama'>
   <option value=0 selected>- Pilih Menu Utama -</option>";
   $tampil=mysql_query("SELECT * FROM mainmenu ORDER BY nama_menu");
   while($r=mysql_fetch_array($tampil)){
   echo "<option value=$r[id_main]>$r[nama_menu]</option>
   </p>";}

       
   echo "</select>

   <p class=inline-small-label> 
   <label for=field4>Link Sub Menu</label>
   <input type=text name='link_sub'  size=50>
   </p> 

   	  
     <div class=block-actions> 
      <ul class=actions-right> 
      <li>
      <a class='button red' id=reset-validate-form href='?module=submenu'>Batal</a>
      </li> </ul>
      <ul class=actions-left> 
      <li>
      <input type='submit' class='button' value='Simpan'></li> </ul> </div> 
	  </form>";
	  
     break;
    
  case "editsubmenu":
    $edit = mysql_query("SELECT * FROM submenu WHERE id_sub='$_GET[id]'");
    $r    = mysql_fetch_array($edit);

		  
echo "<div id=main-content> 
      <div class=container_12>
      <div class=grid_12> 
      <div class=block-border> 
      <div class=block-header> 
      <h1>Edit Submenu</h1>
      <span></span> 
      </div> 
      <div class=block-content> 
	
   <form method=POST action=$aksi?module=submenu&act=update>
   <input type=hidden name=id value=$r[id_sub]>
		  
		  
   <p class=inline-small-label> 
   <label for=field4>Sub Menu</label>
   <input type=text name='nama_sub' value='$r[nama_sub]' >
   </p> 
   
   <p class=inline-small-label> 
   <label for=field4>Sub Menu</label>
   <select name='menu_utama'>";
 
   $tampil=mysql_query("SELECT * FROM mainmenu ORDER BY nama_menu");
   if ($r[id_main]==0){
   echo "<option value=0 selected>- Pilih Menu Utama -</option>";}   

   while($w=mysql_fetch_array($tampil)){
   if ($r[id_main]==$w[id_main]){
   echo "<option value=$w[id_main] selected>$w[nama_menu]</option>";}
   
   else{
   echo "<option value=$w[id_main]>$w[nama_menu]</option></p> ";}}
		  
       
   echo "</select>

   <p class=inline-small-label> 
   <label for=field4>Link Sub Menu</label>
   <input type=text name='link_sub' value='$r[link_sub]' size=50>
   </p> 
   
   	<div class=block-actions> 
      <ul class=actions-right> 
      <li>
      <a class='button red' id=reset-validate-form href='?module=submenu'>Batal</a>
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