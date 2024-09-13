<?php
 include "config/koneksi.php";
	$user=$_POST["user"];
	$pass=$_POST["pass"];
	
	if($user!="" && $pass!=""){
		$em = mysql_query("select * from login where password = '$pass' AND username = '$user'");
		$data = mysql_fetch_assoc($em);
		
		if(mysql_num_rows($em)){
			echo "<div class='alert alert-success alert-dismissable'>
                  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
					Data Telah Ditemukan!!.
                  </div>";
				  session_start();
			$_SESSION["user"]=$data["username"];
			$_SESSION["pass"]=$data["password"];
			
			$_SESSION["namalengkap"]=$data["nama"];
			$_SESSION["leveluser"]   = $data["level"];
			$_SESSION["kd_user"]   = $data["kd_user"];
			
			echo"<script>alert('Selamat Anda Berhasil Login');window.location.href='./'</script>";
		}else{
			echo"<script>alert('Maaf Data Anda Tidak Ditemukan, Silahkan melakukan Registrasi');window.location.href='./'</script>";
		
	}

}
?>
