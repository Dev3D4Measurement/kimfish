<?php
// class paging untuk halaman administrator
class Paging{
// Fungsi untuk mencek halaman dan posisi data
function cariPosisi($batas){
if(empty($_GET['halaman'])){
	$posisi=0;
	$_GET['halaman']=1;
}
else{
	$posisi = ($_GET['halaman']-1) * $batas;
}
return $posisi;
}

// Fungsi untuk menghitung total halaman
function jumlahHalaman($jmldata, $batas){
$jmlhalaman = ceil($jmldata/$batas);
return $jmlhalaman;
}

// Fungsi untuk link halaman 1,2,3 (untuk admin)
function navHalaman($halaman_aktif, $jmlhalaman){
$link_halaman = "";

// Link ke halaman pertama (first) dan sebelumnya (prev)
if($halaman_aktif > 1){
	$prev = $halaman_aktif-1;
	$link_halaman .= "<a href=$_SERVER[PHP_SELF]?module=$_GET[module]&halaman=1><< First</a> | 
                    <a href=$_SERVER[PHP_SELF]?module=$_GET[module]&halaman=$prev>< Prev</a> | ";
}
else{ 
	$link_halaman .= "<< First | < Prev | ";
}

// Link halaman 1,2,3, ...
$angka = ($halaman_aktif > 3 ? " ... " : " "); 
for ($i=$halaman_aktif-2; $i<$halaman_aktif; $i++){
  if ($i < 1)
  	continue;
	  $angka .= "<a href=$_SERVER[PHP_SELF]?module=$_GET[module]&halaman=$i>$i</a> | ";
  }
	  $angka .= " <b>$halaman_aktif</b> | ";
	  
    for($i=$halaman_aktif+1; $i<($halaman_aktif+3); $i++){
    if($i > $jmlhalaman)
      break;
	  $angka .= "<a href=$_SERVER[PHP_SELF]?module=$_GET[module]&halaman=$i>$i</a> | ";
    }
	  $angka .= ($halaman_aktif+2<$jmlhalaman ? " ... | <a href=$_SERVER[PHP_SELF]?module=$_GET[module]&halaman=$jmlhalaman>$jmlhalaman</a> | " : " ");

$link_halaman .= "$angka";

// Link ke halaman berikutnya (Next) dan terakhir (Last) 
if($halaman_aktif < $jmlhalaman){
	$next = $halaman_aktif+1;
	$link_halaman .= " <a href=$_SERVER[PHP_SELF]?module=$_GET[module]&halaman=$next>Next ></a> | 
                     <a href=$_SERVER[PHP_SELF]?module=$_GET[module]&halaman=$jmlhalaman>Last >></a> ";
}
else{
	$link_halaman .= " Next > | Last >>";
}
return $link_halaman;
}
}

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

// class paging untuk halaman produk 
class Paging2{
// Fungsi untuk mencek halaman dan posisi data
function cariPosisi($batas){
if(empty($_GET['halproduk'])){
	$posisi=0;
	$_GET['halproduk']=1;
}
else{
	$posisi = ($_GET['halproduk']-1) * $batas;
}
return $posisi;
}

// Fungsi untuk menghitung total halaman
function jumlahHalaman($jmldata, $batas){
$jmlhalaman = ceil($jmldata/$batas);
return $jmlhalaman;
}

// Fungsi untuk link halaman 1,2,3 
function navHalaman($halaman_aktif, $jmlhalaman){
$link_halaman = "";

// Link ke halaman pertama (first) dan sebelumnya (prev)
if($halaman_aktif > 1){
	$prev = $halaman_aktif-1;
	$link_halaman .= "<span class=firstlast><a href=halproduk-1.html>First</a></span> 
                    <span class=firstlast><a href=halproduk-$prev.html> Prev</a> </span> ";
}
else{ 
	$link_halaman .= "<span class=disabled>First</span>
	                  <span class=disabled>Prev</span> ";
}

// Link halaman 1,2,3, ...
$angka = ($halaman_aktif > 5 ? " ... " : " "); 
for ($i=$halaman_aktif-2; $i<$halaman_aktif; $i++){
  if ($i < 1)
  	continue;
	  $angka .= "<a href=halproduk-$i.html>$i</a> ";
  }
	  $angka .= " <span class=current><b>$halaman_aktif</b></span> ";
	  
    for($i=$halaman_aktif+1; $i<($halaman_aktif+5); $i++){
    if($i > $jmlhalaman)
      break;
	  $angka .= "<a href=halproduk-$i.html>$i</a>  ";
    }
	  $angka .= ($halaman_aktif+2<$jmlhalaman ? " ...  <a href=halproduk-$jmlhalaman.html>$jmlhalaman</a>  " : " ");

$link_halaman .= "$angka";

// Link ke halaman berikutnya (Next) dan terakhir (Last) 
if($halaman_aktif < $jmlhalaman){
	$next = $halaman_aktif+1;
	$link_halaman .= " <a href=halproduk-$next.html>Next</a>  
                     <a href=halproduk-$jmlhalaman.html>Last</a> ";
}
else{
	$link_halaman .= " <span class=disabled>Next</span> 
	                   <span class=disabled>Last</span> ";
}
return $link_halaman;
}
}

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

// class paging untuk halaman kategori
class Paging3{
// Fungsi untuk mencek halaman dan posisi data
function cariPosisi($batas){
if(empty($_GET['halkategori'])){
	$posisi=0;
	$_GET['halkategori']=1;
}
else{
	$posisi = ($_GET['halkategori']-1) * $batas;
}
return $posisi;
}

// Fungsi untuk menghitung total halaman
function jumlahHalaman($jmldata, $batas){
$jmlhalaman = ceil($jmldata/$batas);
return $jmlhalaman;
}

// Fungsi untuk link halaman 1,2,3 
function navHalaman($halaman_aktif, $jmlhalaman){
$link_halaman = "";

// Link ke halaman pertama (first) dan sebelumnya (prev)
if($halaman_aktif > 1){
	$prev = $halaman_aktif-1;
	$link_halaman .= "<span class=firstlast><a href=halkategori-$_GET[id]-1.html>First</a></span> 
                      <span class=firstlast><a href=halkategori--$_GET[id]-$prev.html> Prev</a> </span> ";
}
else{ 
	$link_halaman .= "<span class=disabled>First</span>
	                  <span class=disabled>Prev</span> ";
}

// Link halaman 1,2,3, ...
$angka = ($halaman_aktif > 5 ? " ... " : " "); 
for ($i=$halaman_aktif-2; $i<$halaman_aktif; $i++){
  if ($i < 1)
  	continue;
	  $angka .= "<a href=halkategori-$_GET[id]-$i.html>$i</a> ";
  }
	  $angka .= " <span class=current><b>$halaman_aktif</b></span> ";
	  
    for($i=$halaman_aktif+1; $i<($halaman_aktif+5); $i++){
    if($i > $jmlhalaman)
      break;
	  $angka .= "<a href=halkategori-$_GET[id]-$i.html>$i</a>  ";
    }
	  $angka .= ($halaman_aktif+2<$jmlhalaman ? " ...  <a href=halkategori-$_GET[id]-$jmlhalaman.html>$jmlhalaman</a>  " : " ");

$link_halaman .= "$angka";

// Link ke halaman berikutnya (Next) dan terakhir (Last) 
if($halaman_aktif < $jmlhalaman){
	$next = $halaman_aktif+1;
	$link_halaman .= "<a href=halkategori-$_GET[id]-$next.html>Next</a>  
                      <a href=halkategori-$_GET[id]-$jmlhalaman.html>Last</a> ";
}
else{
	$link_halaman .= " <span class=disabled>Next</span> 
	                   <span class=disabled>Last</span> ";
}
return $link_halaman;
}
}

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

// class paging untuk halaman artikel  
class Paging4{
// Fungsi untuk mencek halaman dan posisi data
function cariPosisi($batas){
if(empty($_GET['halberita'])){
	$posisi=0;
	$_GET['halberita']=1;
}
else{
	$posisi = ($_GET['halberita']-1) * $batas;
}
return $posisi;
}

// Fungsi untuk menghitung total halaman
function jumlahHalaman($jmldata, $batas){
$jmlhalaman = ceil($jmldata/$batas);
return $jmlhalaman;
}

// Fungsi untuk link halaman 1,2,3 
function navHalaman($halaman_aktif, $jmlhalaman){
$link_halaman = "";

// Link ke halaman pertama (first) dan sebelumnya (prev)
if($halaman_aktif > 1){
	$prev = $halaman_aktif-1;
	$link_halaman .= "<span class=firstlast><a href=halberita-1.html>First</a></span> 
                    <span class=firstlast><a href=halberita-$prev.html> Prev</a> </span> ";
}
else{ 
	$link_halaman .= "<span class=disabled>First</span>
	                  <span class=disabled>Prev</span> ";
}

// Link halaman 1,2,3, ...
$angka = ($halaman_aktif > 5 ? " ... " : " "); 
for ($i=$halaman_aktif-2; $i<$halaman_aktif; $i++){
  if ($i < 1)
  	continue;
	  $angka .= "<a href=halberita-$i.html>$i</a> ";
  }
	  $angka .= " <span class=current><b>$halaman_aktif</b></span> ";
	  
    for($i=$halaman_aktif+1; $i<($halaman_aktif+5); $i++){
    if($i > $jmlhalaman)
      break;
	  $angka .= "<a href=halberita-$i.html>$i</a>  ";
    }
	  $angka .= ($halaman_aktif+2<$jmlhalaman ? " ...  <a href=halberita-$jmlhalaman.html>$jmlhalaman</a>  " : " ");

$link_halaman .= "$angka";

// Link ke halaman berikutnya (Next) dan terakhir (Last) 
if($halaman_aktif < $jmlhalaman){
	$next = $halaman_aktif+1;
	$link_halaman .= " <a href=halberita-$next.html>Next</a>  
                     <a href=halberita-$jmlhalaman.html>Last</a> ";
}
else{
	$link_halaman .= " <span class=disabled>Next</span> 
	                   <span class=disabled>Last</span> ";
}
return $link_halaman;
}
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

// class paging untuk halaman download 
class Paging5{
// Fungsi untuk mencek halaman dan posisi data
function cariPosisi($batas){
if(empty($_GET['haldownload'])){
	$posisi=0;
	$_GET['haldownload']=1;
}
else{
	$posisi = ($_GET['haldownload']-1) * $batas;
}
return $posisi;
}

// Fungsi untuk menghitung total halaman
function jumlahHalaman($jmldata, $batas){
$jmlhalaman = ceil($jmldata/$batas);
return $jmlhalaman;
}

// Fungsi untuk link halaman 1,2,3 
function navHalaman($halaman_aktif, $jmlhalaman){
$link_halaman = "";

// Link ke halaman pertama (first) dan sebelumnya (prev)
if($halaman_aktif > 1){
	$prev = $halaman_aktif-1;
	$link_halaman .= "<span class=firstlast><a href=haldownload-1.html>First</a></span> 
                    <span class=firstlast><a href=haldownload-$prev.html> Prev</a> </span> ";
}
else{ 
	$link_halaman .= "<span class=disabled>First</span>
	                  <span class=disabled>Prev</span> ";
}

// Link halaman 1,2,3, ...
$angka = ($halaman_aktif > 5 ? " ... " : " "); 
for ($i=$halaman_aktif-2; $i<$halaman_aktif; $i++){
  if ($i < 1)
  	continue;
	  $angka .= "<a href=haldownload-$i.html>$i</a> ";
  }
	  $angka .= " <span class=current><b>$halaman_aktif</b></span> ";
	  
    for($i=$halaman_aktif+1; $i<($halaman_aktif+5); $i++){
    if($i > $jmlhalaman)
      break;
	  $angka .= "<a href=haldownload-$i.html>$i</a>  ";
    }
	  $angka .= ($halaman_aktif+2<$jmlhalaman ? " ...  <a href=haldownload-$jmlhalaman.html>$jmlhalaman</a>  " : " ");

$link_halaman .= "$angka";

// Link ke halaman berikutnya (Next) dan terakhir (Last) 
if($halaman_aktif < $jmlhalaman){
	$next = $halaman_aktif+1;
	$link_halaman .= " <a href=haldownload-$next.html>Next</a>  
                     <a href=haldownload-$jmlhalaman.html>Last</a> ";
}
else{
	$link_halaman .= " <span class=disabled>Next</span> 
	                   <span class=disabled>Last</span> ";
}
return $link_halaman;
}
}

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

// class paging untuk halaman komentar
class Paging6{
// Fungsi untuk mencek halaman dan posisi data
function cariPosisi($batas){
if(empty($_GET['haltestimonial'])){
	$posisi=0;
	$_GET['haltestimonial']=1;
}
else{
	$posisi = ($_GET['haltestimonial']-1) * $batas;
}
return $posisi;
}

// Fungsi untuk menghitung total halaman
function jumlahHalaman($jmldata, $batas){
$jmlhalaman = ceil($jmldata/$batas);
return $jmlhalaman;
}

// Fungsi untuk link halaman 1,2,3 
function navHalaman($halaman_aktif, $jmlhalaman){
$link_halaman = "";

// Link ke halaman pertama (first) dan sebelumnya (prev)
if($halaman_aktif > 1){
	$prev = $halaman_aktif-1;
	$link_halaman .= "<span class=firstlast><a href=haltestimonial-1.html>First</a></span> 
                    <span class=firstlast><a href=haltestimonial-$prev.html> Prev</a> </span> ";
}
else{ 
	$link_halaman .= "<span class=disabled>First</span>
	                  <span class=disabled>Prev</span> ";
}

// Link halaman 1,2,3, ...
$angka = ($halaman_aktif > 5 ? " ... " : " "); 
for ($i=$halaman_aktif-2; $i<$halaman_aktif; $i++){
  if ($i < 1)
  	continue;
	  $angka .= "<a href=haltestimonial-$i.html>$i</a> ";
  }
	  $angka .= " <span class=current><b>$halaman_aktif</b></span> ";
	  
    for($i=$halaman_aktif+1; $i<($halaman_aktif+5); $i++){
    if($i > $jmlhalaman)
      break;
	  $angka .= "<a href=haltestimonial-$i.html>$i</a>  ";
    }
	  $angka .= ($halaman_aktif+2<$jmlhalaman ? " ...  <a href=haltestimonial-$jmlhalaman.html>$jmlhalaman</a>  " : " ");

$link_halaman .= "$angka";

// Link ke halaman berikutnya (Next) dan terakhir (Last) 
if($halaman_aktif < $jmlhalaman){
	$next = $halaman_aktif+1;
	$link_halaman .= " <a href=haltestimonial-$next.html>Next</a>  
                     <a href=haltestimonial-$jmlhalaman.html>Last</a> ";
}
else{
	$link_halaman .= " <span class=disabled>Next</span> 
	                   <span class=disabled>Last</span> ";
}
return $link_halaman;
}
}

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

// class paging untuk halaman berita
class Paging8{
// Fungsi untuk mencek halaman dan posisi data
function cariPosisi($batas){
if(empty($_GET['halberita'])){
	$posisi=0;
	$_GET['halberita']=1;
}
else{
	$posisi = ($_GET['halberita']-1) * $batas;
}
return $posisi;
}

// Fungsi untuk menghitung total halaman
function jumlahHalaman($jmldata, $batas){
$jmlhalaman = ceil($jmldata/$batas);
return $jmlhalaman;
}

// Fungsi untuk link halaman 1,2,3 
function navHalaman($halaman_aktif, $jmlhalaman){
$link_halaman = "";

// Link ke halaman pertama (first) dan sebelumnya (prev)
if($halaman_aktif > 1){
	$prev = $halaman_aktif-1;
	$link_halaman .= "<span class=firstlast><a href=halberita-1.html>First</a></span> 
                    <span class=firstlast><a href=halberita-$prev.html> Prev</a> </span> ";
}
else{ 
	$link_halaman .= "<span class=disabled>First</span>
	                  <span class=disabled>Prev</span> ";
}

// Link halaman 1,2,3, ...
$angka = ($halaman_aktif > 5 ? " ... " : " "); 
for ($i=$halaman_aktif-2; $i<$halaman_aktif; $i++){
  if ($i < 1)
  	continue;
	  $angka .= "<a href=halberita-$i.html>$i</a> ";
  }
	  $angka .= " <span class=current><b>$halaman_aktif</b></span> ";
	  
    for($i=$halaman_aktif+1; $i<($halaman_aktif+5); $i++){
    if($i > $jmlhalaman)
      break;
	  $angka .= "<a href=halberita-$i.html>$i</a>  ";
    }
	  $angka .= ($halaman_aktif+2<$jmlhalaman ? " ...  <a href=halberita-$jmlhalaman.html>$jmlhalaman</a>  " : " ");

$link_halaman .= "$angka";

// Link ke halaman berikutnya (Next) dan terakhir (Last) 
if($halaman_aktif < $jmlhalaman){
	$next = $halaman_aktif+1;
	$link_halaman .= " <a href=halberita-$next.html>Next</a>  
                     <a href=halberita-$jmlhalaman.html>Last</a> ";
}
else{
	$link_halaman .= " <span class=disabled>Next</span> 
	                   <span class=disabled>Last</span> ";
}
return $link_halaman;
}
}

/////////////////////////////////////////////////////////////////////////////
// class paging untuk halaman paket-jasa-website
class Paging9{
// Fungsi untuk mencek halaman dan posisi data
function cariPosisi($batas){
if(empty($_GET['halpaketjasawebsite'])){
	$posisi=0;
	$_GET['halpaketjasawebsite']=1;
}
else{
	$posisi = ($_GET['halpaketjasawebsite']-1) * $batas;
}
return $posisi;
}

// Fungsi untuk menghitung total halaman
function jumlahHalaman($jmldata, $batas){
$jmlhalaman = ceil($jmldata/$batas);
return $jmlhalaman;
}

// Fungsi untuk link halaman 1,2,3 
function navHalaman($halaman_aktif, $jmlhalaman){
$link_halaman = "";

// Link ke halaman pertama (first) dan sebelumnya (prev)
if($halaman_aktif > 1){
	$prev = $halaman_aktif-1;
	$link_halaman .= "<span class=firstlast><a href=halpaketjasawebsite-1.html>First</a></span> 
                    <span class=firstlast><a href=halpaketjasawebsite-$prev.html> Prev</a> </span> ";
}
else{ 
	$link_halaman .= "<span class=disabled>First</span>
	                  <span class=disabled>Prev</span> ";
}

// Link halaman 1,2,3, ...
$angka = ($halaman_aktif > 5 ? " ... " : " "); 
for ($i=$halaman_aktif-2; $i<$halaman_aktif; $i++){
  if ($i < 1)
  	continue;
	  $angka .= "<a href=halpaketjasawebsite-$i.html>$i</a> ";
  }
	  $angka .= " <span class=current><b>$halaman_aktif</b></span> ";
	  
    for($i=$halaman_aktif+1; $i<($halaman_aktif+5); $i++){
    if($i > $jmlhalaman)
      break;
	  $angka .= "<a href=halpaketjasawebsite-$i.html>$i</a>  ";
    }
	  $angka .= ($halaman_aktif+2<$jmlhalaman ? " ...  <a href=halpaketjasawebsite-$jmlhalaman.html>$jmlhalaman</a>  " : " ");

$link_halaman .= "$angka";

// Link ke halaman berikutnya (Next) dan terakhir (Last) 
if($halaman_aktif < $jmlhalaman){
	$next = $halaman_aktif+1;
	$link_halaman .= " <a href=halpaketjasawebsite-$next.html>Next</a>  
                     <a href=halpaketjasawebsite-$jmlhalaman.html>Last</a> ";
}
else{
	$link_halaman .= " <span class=disabled>Next</span> 
	                   <span class=disabled>Last</span> ";
}
return $link_halaman;
}
}
/////////////////////////////////////////////////////////////////////////////////////////////////
// class paging untuk halaman paket-jasa-website
class Paging10{
// Fungsi untuk mencek halaman dan posisi data
function cariPosisi($batas){
if(empty($_GET['haldigitalsablon'])){
	$posisi=0;
	$_GET['haldigitalsablon']=1;
}
else{
	$posisi = ($_GET['haldigitalsablon']-1) * $batas;
}
return $posisi;
}

// Fungsi untuk menghitung total halaman
function jumlahHalaman($jmldata, $batas){
$jmlhalaman = ceil($jmldata/$batas);
return $jmlhalaman;
}

// Fungsi untuk link halaman 1,2,3 
function navHalaman($halaman_aktif, $jmlhalaman){
$link_halaman = "";

// Link ke halaman pertama (first) dan sebelumnya (prev)
if($halaman_aktif > 1){
	$prev = $halaman_aktif-1;
	$link_halaman .= "<span class=firstlast><a href=haldigitalsablon-1.html>First</a></span> 
                    <span class=firstlast><a href=haldigitalsablon-$prev.html> Prev</a> </span> ";
}
else{ 
	$link_halaman .= "<span class=disabled>First</span>
	                  <span class=disabled>Prev</span> ";
}

// Link halaman 1,2,3, ...
$angka = ($halaman_aktif > 5 ? " ... " : " "); 
for ($i=$halaman_aktif-2; $i<$halaman_aktif; $i++){
  if ($i < 1)
  	continue;
	  $angka .= "<a href=haldigitalsablon-$i.html>$i</a> ";
  }
	  $angka .= " <span class=current><b>$halaman_aktif</b></span> ";
	  
    for($i=$halaman_aktif+1; $i<($halaman_aktif+5); $i++){
    if($i > $jmlhalaman)
      break;
	  $angka .= "<a href=haldigitalsablon-$i.html>$i</a>  ";
    }
	  $angka .= ($halaman_aktif+2<$jmlhalaman ? " ...  <a href=haldigitalsablon-$jmlhalaman.html>$jmlhalaman</a>  " : " ");

$link_halaman .= "$angka";

// Link ke halaman berikutnya (Next) dan terakhir (Last) 
if($halaman_aktif < $jmlhalaman){
	$next = $halaman_aktif+1;
	$link_halaman .= " <a href=haldigitalsablon-$next.html>Next</a>  
                     <a href=haldigitalsablon-$jmlhalaman.html>Last</a> ";
}
else{
	$link_halaman .= " <span class=disabled>Next</span> 
	                   <span class=disabled>Last</span> ";
}
return $link_halaman;
}
}

?>
