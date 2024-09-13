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

$aksi="modul/mod_produk/aksi_produk.php";
switch($_GET[act]){
  // Tampil produk
  default:
echo "<div id=main-content> 
      <div class=container_12> 
      <div class=grid_12> 
      <br/>
	  <a href='?module=produk&act=tambahproduk' class='button'>
	  <span>Tambah Produk<img src='images/plus-small.gif' width='12' height='9'/></span>
      </a></div>";

echo "<div class=grid_12> 
      <div class=block-border> 
      <div class=block-header> 
      <h1>Produk</h1>
      <span></span> 
      </div> 
      <div class=block-content> 
      <table id=table-example class=table>
      <thead> 
      <tr> 
      <th>No</th>
	  <th>Produk</th>
	  <th>Berat</th>
	  <th>Harga</th>
	  <th>Stok</th>
	  <th>Status</th>
	  <th>Terbaru</th>
	  <th>Terlaris</th>
	  <th>Diskon</th>
	  <th>Tgl. masuk</th>
	  <th>Aksi</th>
      </tr> 
      </thead>
	  <tbody>";


    if ($_SESSION[leveluser]=='admin'){
      $tampil = mysql_query("SELECT * FROM produk ORDER BY id_produk DESC");
    }
    else{
      $tampil=mysql_query("SELECT * FROM produk 
                           WHERE username='$_SESSION[namauser]'       
                           ORDER BY id_produk DESC");
    }
  
    $no = $posisi+1;
    while($r=mysql_fetch_array($tampil)){
      $tanggal=tgl_indo($r[tgl_masuk]);
	  $harga       =  number_format(($r[harga]),0,",",".");
echo "<tr class=gradeX> 
      <td>$no</td>
	  <td>$r[nama_produk]</td>
	  <td>$r[berat]</td>
	  <td>$harga</td>
	  <td>$r[stok]</td>
	  <td>$r[discount]</td>
	  <td>$r[terbaru]</td>
	  <td>$r[terlaris]</td>
	  <td>$r[potongan]</td>
	  <td>$tanggal</td>
      <td class=center><a href=?module=produk&act=editproduk&id=$r[id_produk] title='Edit' class='with-tip'><img src='img/icons/packs/fugue/16x16/tick-circle.png'  height='16' width='16'></a> 
				<a href='$aksi?module=produk&act=hapus&id=$r[id_produk]&namafile=$r[gambar]' title='Hapus' class='with-tip' onClick=\"return confirm('Anda yakin menu ini akan dihapus?');\"><img src='img/icons/packs/fugue/16x16/cross-circle.png'  height='16' width='16'></a></td> 
      </tr>  
      ";
      $no++;
      }
echo "</tbody></table> ";

      break; 
  
  
case "tambahproduk":
echo "<div id=main-content> 
      <div class=container_12>
      <div class=grid_12> 
      <div class=block-border> 
      <div class=block-header> 
      <h1>Tambah Produk</h1>
      <span></span> 
      </div> 
      <div class=block-content> 
	  <form method=POST action='$aksi?module=produk&act=input' enctype='multipart/form-data'>
	  <p class=inline-small-label> 
      <label for=field4>Nama Produk</label>
	  <input id=textfield name=nama_produk size=50 class=required type=text value=''/>
      </p> 
	  
      <p class=inline-small-label> 
      <span class=label>Kategori</span>
	  <select name='kategori'>
	  <option value=0 selected>- Pilih Kategori -</option>";
	  $tampil=mysql_query("SELECT * FROM kategoriproduk ORDER BY nama_kategori");
	  while($r=mysql_fetch_array($tampil)){
echo "<option value=$r[id_kategori]>$r[nama_kategori]</option>";
		}
echo "</select></p>
      <p class=inline-small-label> 
      <label for=field4>Berat</label>
	  <input id=textfield name=berat size=20 class=required type=text value=''/>
      </p> 
	  
	  <p class=inline-small-label> 
      <label for=field4>Harga</label>
	  <input id=textfield name=harga size=30 class=required type=text value=''/>
      </p>
	  
	  <p class=inline-small-label> 
      <label for=field4>Stok</label>
	  <input id=textfield name=stok size=20 class=required type=text value=''/>
      </p>

      <p class=inline-small-label> 
      <span class=label>Status Diskon</span>     
	  <input type=radio name='discount' value='Y' checked>Y  
	  <input type=radio name='discount' value='N'> N  
	  *) Apabila produk ingin dijadikan diskon, pilih Diskon = Y
	  </p> 
	  
      <p class=inline-small-label> 
	  <span class=label>Produk Terbaru</span>
	  <input type=radio name='terbaru' value='Y' checked>Y  
	  <input type=radio name='terbaru' value='N'> N  *) Apabila produk ingin di produk terbaru pilih  = Y
	  </p> 
	  
	  <p class=inline-small-label> 
	  <span class=label>Produk Terlaris</span>
	  <input type=radio name='terlaris' value='Y' checked>Y  
	  <input type=radio name='terlaris' value='N'> N  *) Apabila produk ingin di produk terlaris pilih  = Y
	  </p> 
	  
	  <p class=inline-small-label> 
      <label for=field4>Diskon</label>
	  <input id=textfield name=potongan size=30 class=required type=text value=''/>
      </p>
	  
	  <p class=inline-small-label> 
	  <span class=label>Isi produk</span>
	  <textarea name='deskripsi'  style='width: 650px; height: 350px;'></textarea>
	  </p> 
	  
	   <p class=inline-small-label> 
	  <span class=label>Upload</span><input type='file' name='fupload' size='30' /> *) Ukuran gambar max. 800px</p>";

echo "</p>
	  <div class=block-actions> 
      <ul class=actions-right> 
      <li>
      <a class='button red' id=reset-validate-form href='?module=produk'>Batal</a>
      </li> </ul>
      <ul class=actions-left> 
      <li>
      <input type='submit' name='upload' class='button' value='Simpan'></li> </ul> </div> 
	  </form>";
	
	 
	 break;
 
    
  case "editproduk":
    $edit = mysql_query("SELECT * FROM produk WHERE id_produk='$_GET[id]'");
    $r    = mysql_fetch_array($edit);

echo "<div id=main-content> 
      <div class=container_12>
      <div class=grid_12> 
      <div class=block-border> 
      <div class=block-header> 
      <h1>Edit Produk</h1>
      <span></span> 
      </div> 
      <div class=block-content>  
	  <form method=POST enctype='multipart/form-data' action=$aksi?module=produk&act=update>
	  <input type=hidden name=id value=$r[id_produk]>
	  
      <p class=inline-small-label> 
      <label for=field4>Nama Produk</label>
	  <input type=text name='nama_produk' size=60 value='$r[nama_produk]'>
      </p> 
	  
      <p class=inline-small-label> 
      <span class=label>Kategori</span>
	  <select name='kategori'>";
 
          $tampil=mysql_query("SELECT * FROM kategoriproduk ORDER BY nama_kategori");
          if ($r[id_kategori]==0){
            echo "<option value=0 selected>- Pilih Kategori -</option>";
          }   

          while($w=mysql_fetch_array($tampil)){
            if ($r[id_kategori]==$w[id_kategori]){
              echo "<option value=$w[id_kategori] selected>$w[nama_kategori]</option>";
            }
            else{
echo "<option value=$w[id_kategori]>$w[nama_kategori]</option>";
            }
          }

echo "</select></p>";

echo "<p class=inline-small-label> 
      <label for=field4>Berat</label>
	  <input type=text name='berat' size=20 value='$r[berat]'>
      </p> 
	  
	  <p class=inline-small-label> 
      <label for=field4>Harga</label>
	  <input type=text name='harga' size=30 value='$r[harga]'>
      </p>
	  
	  <p class=inline-small-label> 
      <label for=field4>Stok</label>
	  <input type=text name='stok' size=20 value='$r[stok]'>
      </p>";
	  
      if ($r[discount]=='Y'){
echo "<p class=inline-small-label> 
      <span class=label>Status Diskon</span> 
	  <input type=radio name='discount' value='Y' checked> Y  
      <input type=radio name='discount' value='N'> N *) Apabila ada discount, pilih Discount = Y)</p>";
	  }
	  else{
echo "<p class=inline-small-label> 
      <span class=label>Status Diskon</span> 
	  <input type=radio name='discount' value='Y'> Y  
      <input type=radio name='discount' value='N' checked> N *) Apabila ada discount, pilih Discount = Y</p>";
	  }
	  
	  if ($r[terbaru]=='Y'){
echo "<p class=inline-small-label> 
	  <span class=label>Produk Terbaru</span>
	  <input type=radio name='terbaru' value='Y' checked> Y  
      <input type=radio name='terbaru' value='N'> N *)Apabila ada produk terbaru, pilih = Y</p>";								
      }
      else{
echo "<p class=inline-small-label> 
	  <span class=label>Produk Terbaru</span>
	  <input type=radio name='terbaru' value='Y'> Y  
      <input type=radio name='terbaru' value='N' checked> N*)Apabila ada produk terbaru, pilih = Y</p>";
	  }
	  
	  if ($r[terlaris]=='Y'){
echo "<p class=inline-small-label> 
      <span class=label>Produk Terlaris</span>
	  <input type=radio name='terlaris' value='Y' checked> Y  
      <input type=radio name='terlaris' value='N'> N *) Apabila ada produk terlaris, pilih = Y</p>";	
	 }
      else{
echo "<p class=inline-small-label> 
      <span class=label>Produk Terlaris</span>
	  <input type=radio name='terlaris' value='Y'> Y  
      <input type=radio name='terlaris' value='N' checked> N *)Apabila ada produk terlaris, pilih  = Y</p>";	
	  }
	  
echo "<p class=inline-small-label> 
      <label for=field4>Diskon</label>
	  <input type=text name='potongan' size=20 value='$r[potongan]'>
      </p>
	  
	  <p class=inline-small-label> 
	  <span class=label>Isi produk</span>
	  <textarea name='deskripsi' style='width: 600px; height: 350px;'>$r[deskripsi]</textarea>
	  </p>
	  
      <p class=inline-small-label> 
	  <span class=label>Gambar</span>";
          if ($r[gambar]!=''){
              echo "<img src='../aw_produk/small_$r[gambar]'>";  
          }
echo "</p>
	  <p class=inline-small-label> 
	  <span class=label>Gambar</span>
	  <input type='file' name='fupload' size='30' /> *) Ukuran gambar max. 800px. Apabila tidak dirubah dikosongkan</p>";

echo "<div class=block-actions> 
      <ul class=actions-right> 
      <li>
      <a class='button red' type=button id=reset-validate-form href='?module=produk'>Batal</a>
      </li> 
	  </ul>
      <ul class=actions-left> 
      <li>
      <input type='submit' name='update' class='button' value='Simpan'></li> </ul> </div> 
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
