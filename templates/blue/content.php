<script language="javascript">
function validasi(form){
  if (form.nama.value == ""){
    alert("Anda belum mengisikan Nama.");
    form.nama.focus();
    return (false);
  }
  var mincar = 4;
  if (form.nama.value.length < mincar){
    alert("Panjang Karater Nama Minimal 4!");
    form.nama.focus();
    return (false);
  }
  if (form.telpon.value == ""){
    alert("Anda belum mengisikan Telpon.");
    form.telpon.focus();
    return (false);
  }
  if (form.email.value == ""){
    alert("Anda belum mengisikan Email.");
    form.email.focus();
    return (false);
  }   
  if(form.email.value.indexOf("@") == "-1" || form.email.value.indexOf(".") == "-1"){
    alert("Email tidak valid.");
    form.email.focus();
    return (false);
   }  
  if (form.alamat.value == ""){
    alert("Anda belum mengisikan Alamat.");
    form.alamat.focus();
    return (false);
  }
  if (form.ongkos.value == ""){
    alert("Anda belum memilih Jasa Pengiriman dan Kota Tujuan.");
    form.ongkos.focus();
    return (false);
  }
  
  if (form.kode.value == ""){
    alert("Anda belum mengisikan Kode.");
    form.kode.focus();
    return (false);
  }
  return (true);
}

function harusangka(jumlah){
  var karakter = (jumlah.which) ? jumlah.which : event.keyCode
  if (karakter > 31 && (karakter < 48 || karakter > 57))
    return false;

  return true;
}

</script>
<?php
if ($_GET['module']=='store'){
	include "modul/beranda.php";
}
if ($_GET['module']=='profil'){
	include "modul/profil.php";
}
if ($_GET['module']=='pemesanan'){
	include "modul/pemesanan.php";
}
if ($_GET['module']=='halamanstatis'){
	include "modul/page.php";
}
if ($_GET['module']=='produk'){
	include "modul/produk.php";
}
if ($_GET['module']=='produk1'){
	include "modul/produk1.php";
}
if ($_GET['module']=='registrasi'){
	include "modul/registrasi.php";
}
if ($_GET['module']=='login'){
	include "modul/login.php";
}
if ($_GET['module']=='detailproduk'){
	include "modul/detailproduk.php";
}
if ($_GET['module']=='detailkategori'){
	include "modul/detailkategori.php";
}
if ($_GET['module']=='keranjangbelanja'){
	include "modul/keranjangbelanja.php";
}
if ($_GET['module']=='selesaibelanja'){
	include "modul/selesaibelanja.php";
}
if ($_GET['module']=='simpantransaksi'){
	include "modul/simpantransaksi.php";
}
if ($_GET['module']=='berita'){
	include "modul/berita.php";
}
if ($_GET['module']=='detailberita'){
	include "modul/detailberita.php";
}
if ($_GET['module']=='konfirmasi'){
	include "modul/konfirmasi.php";
}
if ($_GET['module']=='testimonial'){
	include "modul/testimonial.php";
}
if ($_GET['module']=='jne'){
	include "modul/jne.php";
}
if ($_GET['module']=='hubungi'){
	include "modul/hubungi.php";
}
if ($_GET['module']=='promo'){
	include "modul/promo.php";
}
if ($_GET['module']=='hasilpencarian'){
	include "modul/hasilpencarian.php";
}
if ($_GET['module']=='lihatpoling'){
	include "modul/poling.php";
}
if ($_GET['module']=='hasilpoling'){
	include "modul/hasilpoling.php";
}
if ($_GET['module']=='cekorder'){
	include "modul/cekorder.php";
}
?>
