<?php
  include "config/koneksi.php";
  $iden=mysql_fetch_array(mysql_query("SELECT url FROM identitas"));
  header("location: $iden[url]");
?>
