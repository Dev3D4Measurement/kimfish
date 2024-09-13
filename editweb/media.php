<?php
session_start();
error_reporting(0);

//fungsi cek akses user
function user_akses($mod,$id){
	$link = "?module=".$mod;
	$cek = mysql_num_rows(mysql_query("SELECT * FROM modul,users_modul WHERE modul.id_modul=users_modul.id_modul AND users_modul.id_session='$id' AND modul.link='$link'"));
	return $cek;
}
//fungsi cek akses menu
function umenu_akses($link,$id){
	$cek = mysql_num_rows(mysql_query("SELECT * FROM modul,users_modul WHERE modul.id_modul=users_modul.id_modul AND users_modul.id_session='$id' AND modul.link='$link'"));
	return $cek;
}
//fungsi redirect
function akses_salah(){
	$pesan = "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Maaf Anda tidak berhak mengakses halaman ini</center>";
 	$pesan.= "<meta http-equiv='refresh' content='2;url=media.php?module=home'>";
	return $pesan;
}

if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){

  echo "
  <link href='css/style.css' rel='stylesheet' type='text/css'>";

  echo "
  </head>
  <body class='special-page'>
  <div id='container'>
  <section id='error-number'>
  
  <img src='img/lock.png'>
  <h1>AKSES ILEGAL</h1>
  
  <p><span class style=\"font-size:14px; color:#ccc;\">
  Maaf, untuk masuk Halaman Administrator
  anda harus Login dahulu!</p></span><br/>
  
  </section>
  
  <section id='error-text'>
  <p><a class='button' href='index.php'>&nbsp;&nbsp; <b>LOGIN DI SINI</b> &nbsp;&nbsp;</a></p>
  </section>
  </div>";
  
}
else{
?>

  <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
  <html xmlns="http://www.w3.org/1999/xhtml">
<head> 
<meta charset=utf-8> 
<link rel=dns-prefetch href="http://fonts.googleapis.com/"> 
<meta http-equiv=X-UA-Compatible content="IE=edge,chrome=1"> 
<title>.:: Administrator Web ::.</title> 
<link href="favicon.ico" rel="shortcut icon"/> 
<meta name=description content=""> 
<meta name=author content=""> 
<meta name=viewport content="width=device-width,initial-scale=1"> 
<link rel=stylesheet href='css/style.css'> 
<link href="http://fonts.googleapis.com/css?family=PT+Sans" rel=stylesheet type="text/css"> 
<script type="text/javascript" src="../js/jquery.min.js"></script>
<script src="js/libs/modernizr-2.0.6.min.js"></script> 

<script language="javascript" type="text/javascript">
    tinyMCE_GZ.init({
    plugins : 'style,layer,table,save,advhr,advimage, ...',
		themes  : 'simple,advanced',
		languages : 'en',
		disk_cache : true,
		debug : false
});
</script>
<script language="javascript" type="text/javascript"
src="editor/tiny_mce_src.js"></script>
<script type="text/javascript">
tinyMCE.init({
		mode : "textareas",
		theme : "advanced",
		plugins : "table,youtube,advhr,advimage,advlink,emotions,flash,searchreplace,paste,directionality,noneditable,contextmenu",
		theme_advanced_buttons1_add : "fontselect,fontsizeselect",
		theme_advanced_buttons2_add : "separator,preview,zoom,separator,forecolor,backcolor,liststyle",
		theme_advanced_buttons2_add_before: "cut,copy,paste,separator,search,replace,separator",
		theme_advanced_buttons3_add_before : "tablecontrols,separator,youtube,separator",
		theme_advanced_buttons3_add : "emotions,flash",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		extended_valid_elements : "hr[class|width|size|noshade]",
		file_browser_callback : "fileBrowserCallBack",
		paste_use_dialog : false,
		theme_advanced_resizing : true,
		theme_advanced_resize_horizontal : false,
		theme_advanced_link_targets : "_something=My somthing;_something2=My somthing2;_something3=My somthing3;",
		apply_source_formatting : true
});

	function fileBrowserCallBack(field_name, url, type, win) {
		var connector = "../../filemanager/browser.html?Connector=connectors/php/connector.php";
		var enableAutoTypeSelection = true;
		
		var cType;
		tinymcpuk_field = field_name;
		tinymcpuk = win;
		
		switch (type) {
			case "image":
				cType = "Image";
				break;
			case "flash":
				cType = "Flash";
				break;
			case "file":
				cType = "File";
				break;
		}
		
		if (enableAutoTypeSelection && cType) {
			connector += "&Type=" + cType;
		}
		
		window.open(connector, "tinymcpuk", "modal,width=300,height=400");
	}
</script>


  </head> 
<body id=top> 
<div id=container> 
<div id=header-surround>
<header id=header>
 <img src="img/admin.png" alt=Grape class=logo> 
 <div class="divider-header divider-vertical"> </div> 
 
 <ul class=toolbox-header>
 
  <li>
  <div class=toolbox-content> 
  <div class=block-border> 
  <div class="block-header small">   </div> 
     </div> 
     </div>
      </li> 
      
      <li> 
      
      <div class=toolbox-content> 
      <div class=block-border> 
      <div class="block-header small">       </div> 
      </div> </div> </li> </ul> 
<div id=user-info>
<p> 
 <?php include "lihatweb.php"; ?>
<a href="logout.php" class="button red">Keluar</a> </p> 

</div>
 </header>
 </div> 
<div class=fix-shadow-bottom-height></div> 
<aside id=sidebar> 
<section id=login-details> 

<?php include "foto.php"; ?>
<div class=clearfix></div> 
</section> 

  <nav id="nav">
  <ul class="menu collapsible shadow-bottom">
	
  <li>
  <a href="javascript:void(0);"><img src="img/icons/packs/fugue/16x16/clipboard-list.png"><b>Halaman Utama</b></a> 
  <ul class="sub">
  <?php include "menu1.php"; ?>
  </ul>
  
  <li>
  <a href="javascript:void(0);"><img src="img/icons/packs/fugue/16x16/produk.png"><b>Manajemen Produk</b></a> 
  <ul class="sub">
  <?php include "menu2.php"; ?>
  </ul>
  
  <li>
  <a href="javascript:void(0);"><img src="img/icons/packs/fugue/16x16/blue-document.png"><b>Manajemen Pelanggan</b></a> 
  <ul class="sub">
  <?php include "menu3.php"; ?>
  </ul>
  
  <li>
  <a href="javascript:void(0);">
   <img src="img/icons/packs/fugue/16x16/ui-tab-content.png"><b>Manajemen Website</b></a> 
  <ul class="sub">
  <?php include "menu4.php"; ?>
  </ul>
  
  </ul>
  </nav> <br/><br/>
    
    
    </aside> 
    <div id=main role=main> 
    <div id=title-bar> 
    <ul id=breadcrumbs> 
    <li><a href="?module=home" title=Home><span id=bc-home></span></a></li> 
    <li class=no-hover><?php include "breadcrumb.php"; ?></li>
     </ul> 
     </div> 
     <div class="shadow-bottom shadow-titlebar"></div> 
     <?php include "content.php"; ?>
     
      </div> 
  <footer id=footer>
  <div class=container_12> 
  <div class=grid_12> 
  <div class="footer-icon align-center"><a class=top href="#top"></a></div> 
  </div> 
  </div>
  </footer> 
  </div> 
  <script src="js/jquery.min.js"></script> 
  <script>window.jQuery||document.write('<script src="js/libs/jquery-1.6.2.min.js"><\/script>');</script> 
  <script defer src='js/AWscript.js'></script> 

   </body> 
</html>


  <?php
  }
  ?>