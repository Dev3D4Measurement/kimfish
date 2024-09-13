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



$aksi="modul/mod_users/aksi_users.php";
switch($_GET[act]){
  // Tampil User
  default:
echo "<div id=main-content> 
      <div class=container_12> 
      <div class=grid_12> 
      <br/>
	  <a href='?module=user&act=tambahuser' class='button'>
	  <span>Tambah User Admin<img src='images/plus-small.gif' width='12' height='9'/></span>
      </a></div>";

    if (empty($_GET['kata'])){
echo "<div class=grid_12> 
      <div class=block-border> 
      <div class=block-header> 
      <h1>User Admin</h1>
      <span></span> 
      </div> 
      <div class=block-content> 
      <table id=table-example class=table>
      <thead> 
      <tr> 
      <th>No.</th> 
      <th>Username</th> 
      <th>Nama Lengkap</th> 
	  <th>Email</th>
	  <th>No.Telp/HP</th>
      <th>Blokir</th> 
	  <th>Aksi</th>
      </tr> 
      </thead>
	  <tbody>";

    $p      = new Paging;
    $batas  = 15;
    $posisi = $p->cariPosisi($batas);

   if ($_SESSION[leveluser]=='admin'){
      $tampil = mysql_query("SELECT * FROM users ORDER BY id_session DESC LIMIT $posisi,$batas");
    }
    else{
      $tampil=mysql_query("SELECT * FROM users WHERE username='$_SESSION[namauser]'");
    }
  
    $no = $posisi+1;
    while($r=mysql_fetch_array($tampil)){
	
echo "<tr class=gradeX> 
      <td>$no</td>
	  <td>$r[username]</td>
	  <td>$r[nama_lengkap]</td>
	  <td><a href=mailto:$r[email]>$r[email]</a></td>
	  <td>$r[no_telp]</td>
	  <td align=center>$r[blokir]</td>
      <td class=center><a href=?module=user&act=edituser&id=$r[id_session] title='Edit' class='with-tip'><img src='img/icons/packs/fugue/16x16/tick-circle.png'  height='16' width='16'></a>  
			</td> 
      </tr>  
      ";
      $no++;
      }
echo "</tbody></table> ";
      break;    
      }

  
   
  
   case "tambahuser":
      if ($_SESSION[leveluser]=='admin'){
echo "<div id=main-content> 
      <div class=container_12>
      <div class=grid_12> 
      <div class=block-border> 
      <div class=block-header> 
      <h1>Tambah User Admin</h1>
      <span></span> 
      </div> 
      <div class=block-content> 
      <form method=POST action='$aksi?module=user&act=input' enctype='multipart/form-data'>
	  <p class=inline-small-label> 
      <label for=field4>Username</label>
	  <input id=textfield name=username size=50 class=required type=text value=''/>
      </p> 
	  
	  <p class=inline-small-label> 
      <label for=field4>Password</label>
	  <input id=textfield name=password size=50 class=required type=text value=''/>
      </p> 
	  
	  <p class=inline-small-label> 
      <label for=field4>Nama Lengkap</label>
	  <input id=textfield name=nama_lengkap size=50 class=required type=text value=''/>
      </p>
	  
	  <p class=inline-small-label> 
      <label for=field4>Email</label>
	  <input id=textfield name=email size=50 class=required type=text value=''/>
      </p>
	  
	  <p class=inline-small-label> 
      <label for=field4>No. Tlp/Hp</label>
	  <input id=textfield name=no_telp size=50 class=required type=text value=''/>
      </p>
	  
	   <p class=inline-small-label> 
	  <span class=label>Upload Foto</span>
	  <input type='file' name='fupload' size='30' /> *) Ukuran gambar max. 100px </p>";
	  
echo "<p class=inline-small-label> 
	  <span class=label>Pilih Hak Akses</span> ";
	  $qrMod = mysql_query("SELECT * FROM modul WHERE publish='Y' AND status='user'");
	  while($mod=mysql_fetch_array($qrMod)){
echo "<input name='modul[]' type='checkbox' value='$mod[id_modul]' /> 
      <span class style=\"color:#000;\">$mod[nama_modul]</span> ";}


echo "<div class=block-actions> 
      <ul class=actions-right> 
      <li>
      <a class='button red' id=reset-validate-form href='?module=user'>Batal</a>
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
    
case "edituser":
   
     $edit=mysql_query("SELECT * FROM users WHERE id_session='$_GET[id]'");
     $r=mysql_fetch_array($edit);
     if($_SESSION[leveluser]=='admin'){
   
echo "<div id=main-content> 
      <div class=container_12>
      <div class=grid_12> 
      <div class=block-border> 
      <div class=block-header> 
      <h1>Edit User Admin</h1>
      <span></span> 
      </div> 
      <div class=block-content> 
     
      <form method=POST action='$aksi?module=user&act=update' enctype='multipart/form-data'>
      <input type=hidden name=id value=$r[id_session]>
	  <input type=hidden name=blokir value='$r[blokir]'>
	  <p class=inline-small-label> 
      <label for=field4>Username</label>
	  <input type=text name='username' size=50 value='$r[username]' disabled>
      </p>
	  
	  <p class=inline-small-label> 
      <label for=field4>Password</label>
	  <input type=text name='password' size=50 value=''>
      </p>  
	  
	  <p class=inline-small-label> 
      <label for=field4>Nama Lengkap</label>
	  <input type=text name='nama_lengkap' size=50 value='$r[nama_lengkap]'>
      </p>
	  
	  <p class=inline-small-label> 
      <label for=field4>Email</label>
	  <input type=text name='email' size=50 value='$r[email]'>
      </p>
	  
	   <p class=inline-small-label> 
      <label for=field4>No. Tlp/Hp</label>
	  <input type=text name='no_telp' size=50 value='$r[no_telp]'>
      </p>";
	  
	   if ($r[blokir]=='N'){
echo "<p class=inline-small-label> 
      <span class=label>Blokir</span>
      <input type=radio name='blokir' value='Y'> Y  
      <input type=radio name='blokir' value='N' checked> N </p>"; 
}
      else{
echo "<p class=inline-small-label> 
      <span class=label>Blokir/span>
      <input type=radio name='blokir' value='Y' checked> Y  
      <input type=radio name='blokir' value='N'> N </p>"; 
  }
	
	  
echo "<p class=inline-small-label> 
	  <span class=label>Gambar</span>";
          if ($r[foto]!=''){
              echo "<img src='../foto_user/small_$r[foto]'>";  
          }
echo "</p>
      <p class=inline-small-label> 
	  <span class=label>Gambar</span>
	  <input type='file' name='fupload' size='30' /> *) Ukuran gambar max. 100px, Apabila tidak dirubah dikosongkan saja</p>";

										  
	
	$qrMod1 = mysql_query("SELECT * FROM modul,users_modul WHERE modul.id_modul=users_modul.id_modul 
	AND users_modul.id_session='$_GET[id]'");
	
echo "<p class=inline-small-label> 
	  <span class=label>Hak Akses</span>";
   	  while($mod1=mysql_fetch_array($qrMod1)){ 
echo "($mod1[nama_modul] -  
      <a href='$aksi?module=user&act=hapusmodule&id=$mod1[id_umod]&sessid=$_GET[id]' title='Hapus' class='with-tip' onClick=\"return confirm('Anda yakin menu ini akan dihapus?');\">
	  <img src='img/icons/packs/fugue/16x16/cross-circle.png'  height='16' width='16'></a>)";
	  }  
	  
	  $qrMod = mysql_query("SELECT * FROM modul WHERE publish='Y' AND status='user'");
echo "<p class=inline-small-label><br/>
	  <span class=label><br/>Tambah Modul</span>";
	  while($mod=mysql_fetch_array($qrMod)){
echo "<input name='modul[]' type='checkbox' value='$mod[id_modul]' />$mod[nama_modul]
	  ";}  
    
echo "<div class=block-actions> 
      <ul class=actions-right> 
      <li>
      <a class='button red' id=reset-validate-form href='?module=user'>Batal</a>
      </li> </ul>
      <ul class=actions-left> 
      <li>
	  
      <input type='submit' name='upload' class='button' value='Simpan'></li> </ul> </div> 
	  </form>";
	  }
	  else 
	  {
	
echo "<div id=main-content> 
      <div class=container_12>
      <div class=grid_12> 
      <div class=block-border> 
      <div class=block-header> 
      <h1>Edit User</h1>
      <span></span> 
      </div> 
      <div class=block-content>
      <form method=POST action='$aksi?module=user&act=update' enctype='multipart/form-data'>
      <input type=hidden name=id value=$r[id_session]>
	  <input type=hidden name=blokir value='$r[blokir]'>
	  <p class=inline-small-label> 
      <label for=field4>Username</label>
	  <input type=text name='username' size=50 value='$r[username]' disabled>
      </p>
	  
	  <p class=inline-small-label> 
      <label for=field4>Password</label>
	  <input type=text name='password' size=50 value=''>
      </p>  
	  
	  <p class=inline-small-label> 
      <label for=field4>Nama Lengkap</label>
	  <input type=text name='nama_lengkap' size=50 value='$r[nama_lengkap]'>
      </p>
	  
	  <p class=inline-small-label> 
      <label for=field4>Email</label>
	  <input type=text name='email' size=50 value='$r[email]'>
      </p>
	  
	   <p class=inline-small-label> 
      <label for=field4>No. Tlp/Hp</label>
	  <input type=text name='no_telp' size=50 value='$r[no_telp]'>
      </p>";
echo "<p class=inline-small-label> 
	  <span class=label>Gambar</span>";
          if ($r[foto]!=''){
              echo "<img src='../foto_user/small_$r[foto]'>";  
          }
echo "<p class=inline-small-label> 
	  <span class=label>Gambar</span>
	  <input type='file' name='fupload' size='30' /> *) Ukuran gambar max. 100px, Apabila tidak dirubah dikosongkan saja</p>";

	   
echo "<div class=block-actions> 
      <ul class=actions-right> 
      <li>
      <a class='button red' id=reset-validate-form href='?module=user'>Batal</a>
      </li> </ul>
      <ul class=actions-left> 
      <li>
	  
      <input type='submit' name='upload' class='button' value='Simpan'></li> </ul> </div> 
	  </form>";}     
	  
	
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
