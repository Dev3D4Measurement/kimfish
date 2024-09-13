<?php 
  error_reporting(0);
  session_start();
  
  $_SESSION['n1'] = rand(1,20);
  $_SESSION['n2'] = rand(1,20);
  $_SESSION['expect'] = $_SESSION['n1']+$_SESSION['n2'];


$tip=$_SESSION['ip'];
$tjam=$_SESSION['jam'];
$ttgl=$_SESSION['tgl'];
if($tip=='' && $tjam=='' && $ttgl==''){				
$ip=$_SERVER['REMOTE_ADDR'];
$jam=date("h:i:s");
$tgl=date("d-m-Y");
$_SESSION ["ip"] = $ip;
$_SESSION ["jam"] = $jam;
$_SESSION ["tgl"] = $tgl;
}
$sip=$_SESSION['ip'];
$sjam=$_SESSION['jam'];
$stgl=$_SESSION['tgl'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
  <html xmlns="http://www.w3.org/1999/xhtml">
  
  <head>
  <title><?php include "config/titel.php"; ?></title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="robots" content="index, follow">
  <meta name="description" content="<?php include "config/deskripsi.php"; ?>">
  <meta name="keywords" content="<?php include "config/keyword.php"; ?>">
  <meta http-equiv="Copyright" content="cvseamalaka" "cvseamalaka@gmail.com">
  <meta name="author" content="cv_seamalaka">
  <meta http-equiv="imagetoolbar" content="no">
  <meta name="language" content="Tanjungbalaiasahan-Indonesia">
  <meta name="revisit-after" content="7">
  <meta name="webcrawlers" content="all">
  <meta name="rating" content="general">
  <meta name="spiders" content="all">
  <!--// SHORTCUT //-->
  <?php 
   $iden=mysql_fetch_array(mysql_query("SELECT * FROM identitas"));
  echo "<link rel='shortcut icon' href='aw_logo/$iden[favicon]' />";
  ?>
   <!--// CSS//-->
   
  <link rel="stylesheet" href="<?php echo "$f[folder]/css/style.css" ?>" type="text/css" />
  <link rel="stylesheet" href="<?php echo "$f[folder]/css/common.css" ?>" type="text/css" />
  <link rel="stylesheet" href="<?php echo "$f[folder]/css/ddsmoothmenu.css" ?>" type="text/css" />
  <link rel="stylesheet" href="<?php echo "$f[folder]/css/paging.css" ?>" type="text/css" />
  <link rel="stylesheet" href="<?php echo "$f[folder]/css/ticker.css" ?>" type="text/css" />
  <link rel="stylesheet" href="<?php echo "$f[folder]/css/keranjang.css" ?>" type="text/css" />
  <link rel="stylesheet" href="<?php echo "$f[folder]/css/kalendar.css" ?>" type="text/css" />
  <link rel="stylesheet" href="<?php echo "$f[folder]/css/jqtransform.css" ?>" type="text/css" />
  <link rel="stylesheet" href="<?php echo "$f[folder]/css/validationEngine.jquery.css" ?>" type="text/css" />
  <link rel="stylesheet" href="<?php echo "$f[folder]/css/demo.css" ?>" type="text/css" />
  <link rel="stylesheet" href="<?php echo "$f[folder]/css/form.css" ?>" type="text/css" />
  <link rel="stylesheet" href="<?php echo "$f[folder]/css/pencarian.css" ?>" type="text/css" />
  <link rel="stylesheet" href="<?php echo "$f[folder]/css/prettyPhoto.css" ?>" type="text/css" />
  <link rel="stylesheet" href="<?php echo "$f[folder]/css/AWkategori.css" ?>" type="text/css" />
  <link rel="stylesheet" href="<?php echo "$f[folder]/css/nivo-slider.css" ?>" type="text/css" />
  <link rel="stylesheet" href="<?php echo "$f[folder]/css/AWbutton.css" ?>" type="text/css" />
  <link rel="stylesheet" href="<?php echo "$f[folder]/css/jsCarousel-2.0.0.css" ?>" type="text/css" />

  <script src="<?php echo "$f[folder]/js/jquery-1.4.3.min.js" ?>" type="text/javascript"></script>
  <!-- nivo slider -->
  <script src="<?php echo "$f[folder]/js/jquery.nivo.slider.js" ?>" type="text/javascript"></script>
  <script src="<?php echo "$f[folder]/js/jquery.nivo.slider.pack.js" ?>" type="text/javascript"></script>
  <script type="text/javascript">
  var $j = jQuery.noConflict();
    $j(window).load(function() {
        $j('#slider').nivoSlider();
    });
    </script>
   <!-- jsCarousel -->
  <script src="<?php echo "$f[folder]/js/jsCarousel-2.0.0.js" ?>" type="text/javascript"></script>
   <script type="text/javascript">
   var $j = jQuery.noConflict();
        $j(document).ready(function() {

            $j('#carouselhAuto').jsCarousel({ onthumbnailclick: function(src) {  }, autoscroll: true, masked: true, itemstodisplay: 4, orientation: 'h' });
			$j('#carouselv').jsCarousel({ onthumbnailclick: function(src) { alert(src); }, autoscroll: true, masked: true, itemstodisplay: 1, orientation: 'v' });

        });       
        
    </script>
  <!-- ddsmoothmenu -->
  <script src="<?php echo "$f[folder]/js/ddsmoothmenu.js" ?>" type="text/javascript"></script>
  <script src="<?php echo "$f[folder]/js/menu.js" ?>" type="text/javascript"></script>
   <!-- menu Kategori -->
  <script src="<?php echo "$f[folder]/js/jquery.accordion.js" ?>" type="text/javascript"></script>
  <script type="text/javascript">
  var $j = jQuery.noConflict();
  $j(document).ready(function() {
	$j('ul.accordion').accordion({
		active: ".selected",
		autoHeight: false,
		header: ".opener",
		collapsible: true,
		event: "click"
	});

 
});	

</script>
  <!-- keranjang belanja -->
  <script src="<?php echo "$f[folder]/js/animatedcollapse.js" ?>" type="text/javascript"></script>
  <script src="<?php echo "$f[folder]/js/collapse.js" ?>" type="text/javascript"></script>
  <!-- vadilasi form -->
  <script src="<?php echo "$f[folder]/js/jquery.jqtransform.js" ?>" type="text/javascript"></script>
  <script src="<?php echo "$f[folder]/js/jquery.validationEngine.js" ?>" type="text/javascript"></script>
  <script src="<?php echo "$f[folder]/js/script.js" ?>" type="text/javascript"></script>
  <script src="<?php echo "$f[folder]/js/niceforms.js" ?>" type="text/javascript"></script>
  

<!-- **********************   Slider produk   ************************** -->
  <script src="<?php echo "$f[folder]/js/jquery.prettyPhoto.js" ?>" type="text/javascript"></script>
	<script type="text/javascript">
	 var $j = jQuery.noConflict();
	  $j(document).ready(function(){
		$j("a[rel^='prettyPhoto']").prettyPhoto({
			animation_speed: 'fast', /* fast/slow/normal */
			slideshow: 5000, /* false OR interval time in ms */
			autoplay_slideshow: false, /* true/false */
			opacity: 0.70, /* Value between 0 and 1 */
			show_title: true, /* true/false */
			allow_resize: true, /* Resize the photos bigger than viewport. true/false */
			default_width: 500,
			default_height: 344,
			counter_separator_label: '/', /* The separator for the gallery counter 1 "of" 2 */
			theme: 'pp_default' /* light_rounded / dark_rounded / light_square / dark_square / facebook */
		});
	  });
	</script>
  <!-- news ticker -->
  <script type="text/javascript">
  var $j = jQuery.noConflict();
	function tick3(){
		$j('#ticker_03 li:first').slideUp( function () { $j(this).appendTo($j('#ticker_03')).slideDown(); });
	}
	setInterval(function(){ tick3 () }, 5000);
    
  </script>
  
  <!-- validasi selesaibelanja -->
<script type="text/javascript">
var $j = jQuery.noConflict();
$j(document).ready(function(){
  $j("#propinsi").change(function(){
    var kategori = $j("#propinsi").val();
    $j.ajax({
	    type: 'GET',
        url: "config/proses_kota.php",
        data: "propinsi=" + kategori,
        success: function(response){
            $j("#kota").html(response);
        }
    });
  });
  
  $j("#kota").change(function(){
    var kota = $j("#kota").val();
    $j.ajax({
	    type: 'GET',
        url: "config/proses_jasa.php",
        data: "kota=" + kota,
        success: function(response){
            $j("#jasa").html(response);
        }
    });
  });
  
    $j("#jasa").change(function(){
    var kota = $j("#jasa").val();
    $j.ajax({
	    type: 'GET',
        url: "config/proses_ongkos.php",
        data: "jasa=" + kota,
        success: function(response){
            $j("#ongkos").val(response);
        }
    });
  });
});
</script>
<!-- Testimonial -->
<script src="<?php echo "$f[folder]/js/jquery-latest.pack.js" ?>" type="text/javascript"></script>
<script src="<?php echo "$f[folder]/js/jcarousellite_1.0.1c4.js" ?>" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function(){
	$(".newsticker-jcarousellite").jCarouselLite({
		vertical: true,
		hoverPause:true,
		visible: 2,
		auto:500,
		speed:1000
	});
});
</script>
<!--========= Tooltip ========================-->
<script src="<?php echo "$f[folder]/js/easy.js" ?>" type="text/javascript"></script>
 <script type="text/javascript">
  $(document).ready(function(){		
  $.easy.tooltip();	
  });</script>
  
<!--========= Facebook ========================-->
  <div id="fb-root"></div>
  <script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/id_ID/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);}(document, 'script', 'facebook-jssdk'));</script>
<!--========= chaptcha ========================-->
<script language='JavaScript' type='text/javascript'>
function refreshCaptcha()
{
	var img = document.images['captchaimg'];
	img.src = img.src.substring(0,img.src.lastIndexOf("?"))+"?rand="+Math.random()*1000;
}
</script>
    </head>


<body>
        <!--MAIN CONTANER START -->
        
           <?php include "content.php";?>

<div class="footer_panel">
<div class="footer_block"></div>
<div class="footer-berita">
<h5 class="berita">Berita Terbaru</h5>
<ul id="ticker_01" class="ticker1">
           <?php
	  $sql=mysql_query("SELECT * FROM berita ORDER BY id_berita DESC LIMIT 2");
      while ($d=mysql_fetch_array($sql)){
	  $tgl = tgl_indo($d['tanggal']);
	  
	  $judul = strip_tags($d['judul']); // membuat paragraf pada isi profil dan mengabaikan tag html
      $judul = substr($judul,0,35); // ambil sebanyak 400 karakter
      $judul = substr($judul,0,strrpos($judul," ")); // potong per spasi kalimat
	  
	  $isi_berita = strip_tags($d['isi_berita']); // membuat paragraf pada isi profil dan mengabaikan tag html
      $isi_berita = substr($isi_berita,0,75); // ambil sebanyak 400 karakter
      $isi_berita = substr($isi_berita,0,strrpos($isi_berita," ")); // potong per spasi kalimat
	  
echo "<li>
      <div class='descripton1'>
      <h4><a href='berita-$d[id_berita]-$d[judul_seo].html' class='tooltip' title='$d[judul]'>$judul...</a></h4>
	  <div class='waktu1'>$d[hari], $tgl  - $d[jam] WIB</div>";
      if ($d[gambar]!=''){
echo "<img src='aw_berita/$d[gambar]' width='50' height='40'>";
      }
echo "<p>$isi_berita...</p>
      </div>
      </li>";
       }
echo "</ul>";
?>
</div>
  <div class="footer">
  <h5 class="poling">Jajak Pendapat</h5>
    <?php
       $tanya=mysql_query("SELECT * FROM poling WHERE aktif='Y' and status='Pertanyaan'");
       $t=mysql_fetch_array($tanya);
echo "<div class='AWpoling'>$t[pilihan]</div>";
echo "<form method=POST action='hasil-poling.html'>";
      $poling=mysql_query("SELECT * FROM poling WHERE aktif='Y' and status='Jawaban'");
      while ($p=mysql_fetch_array($poling)){
echo "<div class='AWpolingpertanyaan'>
      <input type=radio name=pilihan value='$p[id_poling]'/>
      $p[pilihan]</div>";
	  }
echo "<div class='AWbtn-poling'>
      <input class='simplebtn' type='submit' value='Pilih'> 
      </form>
      <a href='poling.html' class='simplebtn'>LIHAT</a></div> ";
  ?>        
  </div>
  
<div class="footer">
        	<h5 class="visitor">Pengunjung</h5>
            <ul>
            <?php
		$ip=$_SERVER['REMOTE_ADDR'];
		$tanggal=date("d-m-Y");
		$tgl=date("d");
		$bln=date("m");
		$thn=date("Y");
		$tglk=$tgl-1;
		$baca=mysql_query("SELECT * FROM konter WHERE ip='$sip' AND tanggal='$stgl' AND waktu='$sjam'");
		$baca1=mysql_num_rows($baca);
		if($baca1==0){
			$tkonter=mysql_query("INSERT INTO konter VALUES ('$sip','$stgl','$sjam')");
		}
			$q=mysql_query("SELECT * FROM konter");
			$blan=date("m-Y");
			$bulan=mysql_query("SELECT * FROM konter WHERE tanggal LIKE '%$blan%'");
			$tahunini=mysql_query("SELECT * FROM konter WHERE tanggal LIKE '%$thn%'");
			$today=mysql_query("SELECT * FROM konter WHERE tanggal='$tanggal'");
		    if($tglk=='1' | $tglk=='2' | $tglk=='3' | $tglk=='4' | $tglk=='5' | $tglk=='6' | $tglk=='7' | $tglk=='8' | $tglk=='9'){
		    $kemarin=mysql_query("SELECT * FROM konter WHERE tanggal='0$tglk-$bln-$thn'");
		    } else {
			$kemarin=mysql_query("SELECT * FROM konter WHERE tanggal='$tglk-$bln-$thn'");
			}
			$visitor = mysql_num_rows($q);
			$bulan1=mysql_num_rows($bulan);
			$tahunini1=mysql_num_rows($tahunini);
			$kemarin1 = mysql_num_rows($kemarin);
			$todays=mysql_num_rows($today);
		?>
		<table width="189" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td width="20"><img src="icon/online.png" width="14" height="14" /></td>
              <td width="90"> Online </td>
              <td width="80">: <?php include "statistik/useronline.php"; ?> </td>
          </tr>
            <tr>
              <td><img src="icon/hariini.png" width="14" height="14" /></td>
              <td>Hari Ini  </td>
              <td>: 
                <?=$todays;?></td>
          </tr>
            <tr>
              <td><img src="icon/hariini.png" width="14" height="14" /></td>
              <td>Kemarin</td>
              <td>: 
                <?=$kemarin1;?></td>
          </tr>
            <tr>
              <td><img src="icon/hariini.png" width="14" height="14" /></td>
              <td>Bulan Ini</td>
              <td> : 
                <?=$bulan1;?></td>
          </tr>
            <tr>
            <td><img src="icon/hariini.png" width="14" height="14" /></td>
              <td> Tahun Ini </td>
              <td>: 
                <?=$tahunini1;?></td>
          </tr>
            <tr>
            <td><img src="icon/total.png" width="14" height="14" /></td>
              <td> Total</td>
              <td>: 
                <?=$visitor;?></td>
          </tr>
          </table>
            </ul>
  </div>
  <div class="footer">
        	<h5 class="about">Hubungi Kami</h5>
            <ul>
            <?php
$iden=mysql_fetch_array(mysql_query("SELECT * FROM identitas"));
echo "<p><span class='bold'></span> $iden[alamat]</p>";

?>
            </ul>
  </div>
</div>
<!--FOOTER PANEL END -->
<!--COPYRIGHT START -->
<?php
$iden=mysql_fetch_array(mysql_query("SELECT * FROM identitas"));
echo "<div class='copyright'>Copyright &copy; 2017 <b>$iden[nama_website]</b>
      </div>";
?>
<!--COPYRIGHT END -->
  <!-- kalendar -->
  <script src="<?php echo "$f[folder]/js/datepicker.js" ?>" type="text/javascript"></script>
  <script type="text/javascript">
  $(function(){
	$("#tglpembayaran").datepicker({dateFormat: 'yy-dd-mm' });
  })	

</script>
</body>
</html>